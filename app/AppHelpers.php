<?php
namespace App;
class AppHelpers
{
    public static function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
    }
    public static function setSessionData($key,$value){
        $_SESSION[$_SESSION['login_id']][$key] = $value;
        return isset($_SESSION[$_SESSION['login_id']][$key])?true:false;
    }
    public static function getSessionData($key){
        return $_SESSION[$_SESSION['login_id']][$key];
    }
    public static function removeSessionData($key){
        unset($_SESSION[$_SESSION['login_id']][$key]);
        return !isset($_SESSION[$_SESSION['login_id']][$key])?true:false;
    }
    
}
