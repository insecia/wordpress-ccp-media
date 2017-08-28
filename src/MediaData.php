<?php

declare(strict_types = 1);

namespace Insecia\Api;

class MediaData 
{
    public static function getMediaData(): string
    {
        $reponse = UrlFetcher::fetchJson(\Config::mediaApiBasePath() . '/file/' . $_GET['media'] . '/metadata/iptc');
        $imageDetailTemplate = \Config::imageDetailsTemplate();

        if($reponse['status'] === 'OK') {
            $iptcData = $reponse['message'];

            $imageDetailTemplate = strtr($imageDetailTemplate, [
                '%IPTC_FIELD_DATE_CREATED%' => isset($iptcData['FIELD_DATE_CREATED']['value'][0]) ? date('d.m.Y', strtotime($iptcData['FIELD_DATE_CREATED']['value'][0])) : '',
                '%IPTC_FIELD_BY_LINE%' => isset($iptcData['FIELD_BY_LINE']['value'][0]) ? rtrim(implode(', ', $iptcData['FIELD_BY_LINE']['value']), ', ') : '',
                '%IPTC_FIELD_COPYRIGHT_NOTICE%' => $iptcData['FIELD_COPYRIGHT_NOTICE']['value'][0] ?? '',
                '%IPTC_FIELD_KEYWORDS%' => isset($iptcData['FIELD_KEYWORDS']['value'][0]) ? rtrim(implode(', ', $iptcData['FIELD_KEYWORDS']['value']), ', ') : ''
            ]);
        }

        $response = UrlFetcher::fetchJson(\Config::mediaApiBasePath() . '/file/' . $_GET['media'] . '/data?&token=' . $_SESSION['insecia_api_token']);
        if($reponse['status'] === 'OK') {
            $imageData = $response['message'];

            $imageDetailTemplate = strtr($imageDetailTemplate, [
                '%IMAGE_NAME%' => $imageData['name'],
                '%IMAGE_DESCRIPTION%' => $imageData['description']
            ]);
        }

        return strtr($imageDetailTemplate, [
            '%IMAGE_PATH%' => \Config::mediaApiBasePath() . '/file/' . $_GET['media'] . '/raw?token=' . $_SESSION['insecia_api_token']
        ]);
    }
} 