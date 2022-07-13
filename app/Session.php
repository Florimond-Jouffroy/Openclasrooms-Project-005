<?php

namespace App;

class Session
{
    private static $instance;
    public static function get(string $data)
    {
        return $_SESSION[$data];
    }

    public static function put(string $data, $value)
    {
        $_SESSION[$data] = $value;
    }

    public static function flash($type, $msg)
    {
        $_SESSION['flash'] = $msg;
        $_SESSION['flash_type'] = $type;
    }

    public static function start()
    {
        if(!isset(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct() {
        if(session_id() == '') {
            session_start();
        }
        session_regenerate_id();
    }

    public static function has($data)
    {
        return isset($_SESSION[$data]);
    }

    public static function hasFlash()
    {
        return isset($_SESSION['flash']);
    }

    public static function getFlashType()
    {
        return $_SESSION['flash_type'];
    }

    public static function getFlash()
    {
        return $_SESSION['flash'];
    }

    public static function delete($data)
    {
        unset($_SESSION[$data]);
    }

    public static function destroy()
    {
        session_unset();
        session_destroy();
    }
}