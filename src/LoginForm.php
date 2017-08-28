<?php

declare(strict_types = 1);

namespace Insecia\Api;

class LoginForm {
    public static function getLoginForm(): string
    {
        $var = \Config::loginFormTemplate();

        return strtr($var, [
            '%API_BASE_PATH%' => \Config::apiBasePath()
        ]);
    }
} 
