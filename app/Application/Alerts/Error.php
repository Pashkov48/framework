<?php

namespace App\Application\Alerts;

class Error implements ErrorInterface
{
    private static array $errors;
    //json_encode преобразует массив в формат json
    //в виде строки и помесить его в cookie
    public static function store(array $errors): void
    {
        setcookie('errors', json_encode($errors, JSON_UNESCAPED_UNICODE));
    }

    public static function list(): array
    {
        if (!isset(self::$errors)) {
            self::$errors = isset($_COOKIE['errors']) ? json_decode($_COOKIE['errors'], true) : [];
        }
        return self::$errors;
    }

    public static function has(string $key): bool
    {
        return isset(self::list()[$key]);
    }

    public static function get(string $key, bool $all = false): null|string|array
    {
        if (isset(self::list()[$key])) {
            $return = $all ? self::list()[$key] : self::list()[$key][0];
            unset(self::$errors[$key]);
            self::store(self::list());
            return $return;
        } else {
            return null;
        }
    }
}