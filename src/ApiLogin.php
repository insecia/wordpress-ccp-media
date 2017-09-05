<?php

namespace Insecia\Api;

class ApiLogin 
{
    const ERROR_USER_NOT_FOUND = 1;
    const ERROR_LOGIN_FAILED = 2;

    private $user = null;
    private $pass = null;
    private $errorType = null;

    public static function forUser($user, $pass)
    {
        $instance = new self();
        $instance->user = $user;
        $instance->pass = $pass;
        return $instance;
    }

    public function login()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, \Config::apiBasePath() . '/authentication/token');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "user={$this->user}&pass={$this->pass}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);

        if($result !== false) {
            $jsonResult = json_decode($result, true);

            if($jsonResult['status'] === 'OK') {
                $_SESSION['insecia_api_token'] = $jsonResult['token'];

                return true;
            } else {
                $this->errorType = self::ERROR_USER_NOT_FOUND;
                return false;
            }
        } else {
            $this->errorType = self::ERROR_LOGIN_FAILED;
            return false;
        }
    }

    public function getError()
    {
        return $this->errorType;
    }

    public static function inseciaApiLogin()
    {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $apiLogin = self::forUser($user, $pass);
        $result = $apiLogin->login();

        if(!$result) {
            $errorType = $apiLogin->getError();

            if($errorType === self::ERROR_USER_NOT_FOUND) {
                echo json_encode(['status' => 'NOK', 'message' => 'user_not_found']);
            } else {
                echo json_encode(['status' => 'NOK', 'message' => 'login_failed']);
            }
        } else {
            echo json_encode(['status' => 'OK']);
        }

        die();
    }
}
