<?php

class Config {
    public static function projectId()
    {
        return (int)get_option('project_id');
    }

    public static function apiBasePath()
    {
        return get_option('api_base_path');
    }

    public static function mediaApiBasePath()
    {
        return self::apiBasePath() . '/cms/media-manager/project/' . self::projectId();
    }

    public static function rootDirectoryId()
    {
        return (int)get_option('root_directory_id');
    }

    public static function directoryTemplate()
    {
        return get_option('directory_template');
    }

    public static function fileTemplate()
    {
        return get_option('file_template');
    }

    public static function mediaBrowserStyle()
    {
        return get_option('media_browser_style');
    }

    public static function imageDetailsTemplate()
    {
        return get_option('image_details_template');
    }

    public static function loginFormTemplate()
    {
        return get_option('login_form_template');
    }

    public static function tokenInvalidError()
    {
        return get_option('error_token_invalid');
    }

    public static function noRightsError()
    {
        return get_option('error_no_rights');
    }

    public static function tokenExpiredError()
    {
        return get_option('error_token_expired');
    }
}
