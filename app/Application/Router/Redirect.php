<?php

namespace App\Application\Router;
//редирект на страницы
class Redirect implements RedirectInterface
{

    public static function to($route): void
    {
        header("Location: $route");
        die();
    }
}