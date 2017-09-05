<?php

namespace Insecia\Api;

class LoginForm {
    public static function getLoginForm()
    {
        $var = \Config::loginFormTemplate();

        return strtr($var, [
            '%API_BASE_PATH%' => \Config::apiBasePath()
        ]);
    }
} 
