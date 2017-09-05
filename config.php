<?php

include 'default-config.php';

class Config {
    public static function projectId()
    {
        return (int)get_option('insecia_ccp_media_project_id');
    }

    public static function apiBasePath()
    {
        return get_option('insecia_ccp_media_api_base_path');
    }

    public static function mediaApiBasePath()
    {
        return self::apiBasePath() . '/cms/media-manager/project/' . self::projectId();
    }

    public static function rootDirectoryId()
    {
        return (int)get_option('insecia_ccp_media_root_directory_id');
    }

    public static function loginPageUrl()
    {
        return get_option('insecia_ccp_media_login_page_url');
    }

    public static function mediaBrowserPageUrl()
    {
        return get_option('insecia_ccp_media_media_browser_page_url');
    }

    public static function mediaViewPageUrl()
    {
        return get_option('insecia_ccp_media_media_view_page_url');
    }

    public static function redirectAfterLoginUrl()
    {
        return get_option('insecia_ccp_media_redirect_after_login_url');
    }

    public static function registrationFormUrl()
    {
        return get_option('insecia_ccp_media_registration_form_url');
    }

    public static function directoryTemplate()
    {
        $option = get_option('insecia_ccp_media_directory_template');
        return self::parseSettingPlaceholders(
            empty($option) ? MEDIA_DIRECTORY_TEMPLATE : $option
        );
    }

    public static function fileTemplate()
    {
        $option = get_option('insecia_ccp_media_file_template');
        return self::parseSettingPlaceholders(
            empty($option) ? MEDIA_FILE_TEMPLATE : $option
        );
    }

    public static function mediaBrowserStyle()
    {
        $option = get_option('insecia_ccp_media_media_browser_style');
        return self::parseSettingPlaceholders(
            empty($option) ? MEDIA_BROWSER_STYLE : $option
        );
    }

    public static function imageDetailsTemplate()
    {
        $option = get_option('insecia_ccp_media_image_details_template');
        return self::parseSettingPlaceholders(
            empty($option) ? IMAGE_DETAILS_TEMPLATE : $option
        );
    }

    public static function loginFormTemplate()
    {
        $option = get_option('insecia_ccp_media_login_form_template');
        return self::parseSettingPlaceholders(
            empty($option) ? LOGIN_FORM_TEMPLATE : $option
        );
    }

    public static function tokenInvalidError()
    {
        $option = get_option('insecia_ccp_media_error_token_invalid');
        return self::parseSettingPlaceholders(
            empty($option) ? ERROR_TOKEN_INVALID : $option
        );
    }

    public static function noRightsError()
    {
        $option = get_option('insecia_ccp_media_error_no_rights');
        return self::parseSettingPlaceholders(
            empty($option) ? ERROR_NO_RIGHTS : $option
        );
    }

    public static function tokenExpiredError()
    {
        $option = get_option('insecia_ccp_media_error_token_expired');
        return self::parseSettingPlaceholders(
            empty($option) ? ERROR_TOKEN_EXPIRED : $option
        );
    }

    private static function parseSettingPlaceholders($template) {
        return strtr($template, [
            '%SETTING_LOGIN_PAGE_URL%' => self::loginPageUrl(),
            '%SETTING_MEDIA_BROWSER_PAGE_URL%' => self::mediaBrowserPageUrl(),
            '%SETTING_MEDIA_VIEW_PAGE_URL%' => self::mediaViewPageUrl(),
            '%SETTING_REDIRECT_AFTER_LOGIN_URL%' => self::redirectAfterLoginUrl(),
            '%SETTING_REGISTRATION_FORM_URL%' => self::registrationFormUrl()
        ]);
    }
}
