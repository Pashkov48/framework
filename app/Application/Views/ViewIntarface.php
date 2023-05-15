<?php

namespace App\Application\Views;

interface ViewIntarface
{
    public static function show(string $view, array $params=[]): void;

    public static function exception(\Exception $e): void;

    //метод для подключений в HTML компонентов и сокращения записей
    public static function component(string $component): void;

    public static function error(string $code): void;
}