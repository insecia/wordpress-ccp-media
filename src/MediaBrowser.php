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
        $retContent .= \Config::mediaBrowserStyle();
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
                        '%DIR_NAME%' => $directory['name'],
                        '%DIR_DESCRIPTION%' => $directory['description'],
                        '%DIR_ID%' => $directory['directoryID'],
                        '%DIR_PICTURE_PATH%' => \Config::mediaApiBasePath() . '/file/' . $directory['mainPictureID'] . '/raw?token=' . $_SESSION['insecia_api_token']
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
                        '%IMAGE_NAME%' => $file['name'],
                        '%IMAGE_DESCRIPTION%' => $file['description'],
                        '%IMAGE_PATH%' => \Config::mediaApiBasePath() . '/file/' . $file['mediaID'] . '/raw?height=140&token=' . $_SESSION['insecia_api_token'],
                        '%MEDIA_ID%' => $file['mediaID'],
                        '%FILE_SIZE%' => $file['fileSize'],
                        '%FILE_TYPE%' => $file['fileType'],
                        '%UPLOAD_DATE%' => $file['uploadDate']
                    ]
                );
            }
        } else {
            if($content['message'] === 'token_invalid') {
                echo \Config::tokenInvalidError();
            } else if($content['message'] === 'no_rights') {
                echo \Config::noRightsError();
            } else if($content['message'] === 'token_expired') {
                echo \Config::tokenExpiredError();
            } else {
                echo 'Ein unbekannter Fehler ist aufgetreten.';
            }
        }
        return ob_get_clean();
    }
}
