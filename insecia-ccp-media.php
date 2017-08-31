<?php
/*
Plugin Name: Insecia CCP Media
Plugin URI: https://insecia.com
Description: Insecia CCP MediaManager integration
*/

session_start();

require_once 'src/ApiLogin.php';
require_once 'src/UrlFetcher.php';
require_once 'src/IptcFormatter.php';
require_once 'src/MediaBrowser.php';
require_once 'src/MediaData.php';
require_once 'src/LoginForm.php';
require_once 'config.php';

add_shortcode(
    'insecia_ccp_media_browser', 
    [Insecia\Api\MediaBrowser::class, 'getMediaBrowser']
);

add_shortcode(
    'insecia_ccp_media_view',
    [Insecia\Api\MediaData::class, 'getMediaData']
);

add_shortcode(
    'insecia_ccp_login', 
    [Insecia\Api\LoginForm::class, 'getLoginForm']
);

add_action(
    'wp_ajax_insecia_api_login', 
    [Insecia\Api\ApiLogin::class, 'inseciaApiLogin']
);

add_action(
    'wp_ajax_nopriv_insecia_api_login', 
    [Insecia\Api\ApiLogin::class, 'inseciaApiLogin']
);

include 'settings.php';
 