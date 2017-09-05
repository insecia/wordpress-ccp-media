<?php

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

    public static function directoryTemplate()
    {
        return get_option('insecia_ccp_media_directory_template');
    }

    public static function fileTemplate()
    {
        return get_option('insecia_ccp_media_file_template');
    }

    public static function mediaBrowserStyle()
    {
        return get_option('insecia_ccp_media_media_browser_style');
    }

    public static function imageDetailsTemplate()
    {
        return get_option('insecia_ccp_media_image_details_template');
    }

    public static function loginFormTemplate()
    {
        return get_option('insecia_ccp_media_login_form_template');
    }

    public static function tokenInvalidError()
    {
        return get_option('insecia_ccp_media_error_token_invalid');
    }

    public static function noRightsError()
    {
        return get_option('insecia_ccp_media_error_no_rights');
    }

    public static function tokenExpiredError()
    {
        return get_option('insecia_ccp_media_error_token_expired');
    }
}
