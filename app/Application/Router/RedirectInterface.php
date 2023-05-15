<?php

namespace App\Application\Router;

interface RedirectInterface
{
    public static function to($route): void;
}