<?php

class Flash
{
    protected static function ensureSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $message)
    {
        self::ensureSession();
        $_SESSION['flash'][$key] = $message;
    }

    public static function get($key)
    {
        self::ensureSession();
        if (isset($_SESSION['flash'][$key])) {
            $message = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $message;
        }
        return null;
    }

    public static function has($key)
    {
        self::ensureSession();
        return isset($_SESSION['flash'][$key]);
    }

    public static function display($key)
    {
        if (self::has($key)) {
            echo '<div class="flash-message">' . self::get($key) . '</div>';
        }
    }
}
