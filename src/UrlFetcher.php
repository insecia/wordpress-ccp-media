<?php

namespace Insecia\Api;

class UrlFetcher 
{
    public static function fetchJson($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $_SESSION['insecia_api_token']
        ]);

        $content = curl_exec($ch);
        curl_close($ch);


        if($content !== false) {
            return json_decode($content, true);
        } else {
            return ['status' => 'NOK'];
        }
    }
}
