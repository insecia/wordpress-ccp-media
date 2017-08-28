<?php

declare(strict_types = 1);

namespace Insecia\Api;

class MediaBrowser 
{
    public static function getMediaBrowser(): string 
    {
        $dirId = (int)($_GET['parent'] ?? \Config::rootDirectoryId());

        $retContent = '';
        $retContent .= self::getDirectories($dirId);
        $retContent .= self::getFiles($dirId);
        $retContent .= \Config::directoryTemplateStyle();
        $retContent .= \Config::fileTemplateStyle();
        $retContent .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">';
        $retContent .= '<div style="clear: both"></div>';
        return $retContent;
    }

    private static function getDirectories(int $dirId): string
    {
        $content = UrlFetcher::fetchJson(\Config::mediaApiBasePath() . '/directories/' . $dirId);

        ob_start();
        if($content['status'] === 'OK') {
            foreach($content['message'] as $directory) {

                echo strtr(
                    \Config::directoryTemplate(), [
                        '%NAME%' => $directory['name'],
                        '%DESCRIPTION%' => $directory['description'],
                        '%DIR_ID%' => $directory['directoryID'],
                        '%DIR_PICTURE_PATH%' => \Config::mediaApiBasePath() . '/file/' . $directory['mainPictureID'] . '/raw'
                    ]
                );

            }
        } 
        return ob_get_clean();
    }

    private static function getFiles(int $dirId): string 
    {
        $content = UrlFetcher::fetchJson(\Config::mediaApiBasePath() . '/directory/' . $dirId . '/files');

        ob_start();
        if($content['status'] === 'OK') {
            foreach($content['message'] as $file) {

                echo strtr(
                    \Config::fileTemplate(), [
                        '%NAME%' => $file['name'],
                        '%DESCRIPTION%' => $file['description'],
                        '%IMAGE_PATH%' => \Config::mediaApiBasePath() . '/file/' . $file['mediaID'] . '/raw?height=140',
                        '%MEDIA_ID%' => $file['mediaID']
                    ]
                );
            }
        } else {
            if($content['message'] === 'token_invalid') {
                echo '<a href="beispielseite-login">Sie müssen sich anmelden, um diese Inhalte sehen zu können.</a>';
            } else if($content['message'] === 'no_rights') {
                echo 'Sie haben keine ausreichenden Rechte, um diese Inhalte zu sehen.';
            } else if($content['message'] === 'token_expired') {
                echo '<a href="beispielseite-login">Ihre Sitzung ist abgelaufen. Bitte melden Sie sich erneut an.</a>';
            }
        }
        return ob_get_clean();
    }
}