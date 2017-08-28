<?php

declare(strict_types = 1);


class Config {
    public static function projectId() :int 
    {
        return (int)get_option('project_id');
    }

    public static function apiBasePath(): string
    {
        return get_option('api_base_path');
    }

    public static function mediaApiBasePath(): string 
    {
        return self::apiBasePath() . '/cms/media-manager/project/' . self::projectId();
    }

    public static function rootDirectoryId(): int 
    {
        return (int)get_option('root_directory_id');
    }

    public static function directoryTemplate(): string
    {
        return get_option('directory_template');
    }

    public static function fileTemplate(): string 
    {
        return get_option('file_template');
    }

    public static function directoryTemplateStyle(): string 
    {
        return get_option('directory_template_style');
    }

    public static function fileTemplateStyle(): string 
    {
        return get_option('file_template_style');
    }

    public static function imageDetailsTemplate(): string 
    {
        return get_option('image_details_template');
    }

    public static function loginFormTemplate(): string 
    {
        return get_option('login_form_template');
    }
}
