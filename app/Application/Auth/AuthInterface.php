<?php

namespace App\Application\Auth;

use App\Application\Database\Model;

interface AuthInterface
{
    public static function init(): void;

    //проверка авторизирован ли пользователь сейчас
    public static function check(): bool;

    //возвращает информ об авторизированном пользователе
    public static function user(): Model;

    public static function getTokenColumn(): string;

    public static function id(): ?int;
}