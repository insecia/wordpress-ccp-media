<?php

namespace Insecia\Api;

class MediaData 
{
    const DISPLAYED_IPTC_FIELDS = [
        'FIELD_DATE_CREATED',
        'FIELD_BY_LINE',
        'FIELD_COPYRIGHT_NOTICE',
        'FIELD_KEYWORDS'
    ];

    public static function getMediaData()
    {
        
        $imageDetailTemplate = \Config::imageDetailsTemplate();

        $imageDetailTemplate = self::replaceIptcPlaceholders($imageDetailTemplate);
        $imageDetailTemplate = self::replaceImageDataPlaceholders($imageDetailTemplate);        

        return strtr($imageDetailTemplate, [
            '%IMAGE_PATH%' => \Config::mediaApiBasePath() . '/file/' . $_GET['media'] . '/raw?token=' . $_SESSION['insecia_api_token']
        ]);
    }

    private static function replaceIptcPlaceholders($imageDetailTemplate) 
    {
        $response = UrlFetcher::fetchJson(\Config::mediaApiBasePath() . '/file/' . $_GET['media'] . '/metadata/iptc');

        if($response['status'] === 'OK') {
            $iptcData = $response['message'];

            foreach(self::DISPLAYED_IPTC_FIELDS as $field) {
                $iptcValue = isset($iptcData[$field]['value']) ? $iptcData[$field]['value'] : null;

                $imageDetailTemplate = str_replace(
                    "%IPTC_{$field}%", 
                    $iptcValue !== null ? IptcFormatter::format($field, $iptcValue) : '', 
                    $imageDetailTemplate
                );
            }
        }

        return $imageDetailTemplate;
    }

    private static function replaceImageDataPlaceholders($imageDetailTemplate) 
    {
        $response = UrlFetcher::fetchJson(\Config::mediaApiBasePath() . '/file/' . $_GET['media'] . '/data');

        if($response['status'] === 'OK') {
            $imageData = $response['message'];

            $imageDetailTemplate = strtr($imageDetailTemplate, [
                '%IMAGE_NAME%' => $imageData['name'],
                '%IMAGE_DESCRIPTION%' => $imageData['description']
            ]);
        }

        return $imageDetailTemplate;
    }
} 
