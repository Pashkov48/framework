<?php

namespace App\Application\Views;

use App\Application\Config\Config;
use App\Exceptions\ComponentNotFoundException;
use App\Exceptions\ViewNotFoundException;
use Exception;

class View implements ViewIntarface
{
    //подключение страницы
    /**
     * @throws ViewNotFoundException
     */
    public static function show(string $view, array $params = []): void
    {
        //созадем переменную для Title страницы
        extract($params);
        $path = __DIR__ . "/../../../views/$view.view.php";
        //если файл существует, то подключаем его
        if (!file_exists($path)) {
            throw new ViewNotFoundException("View ($view) not found");
        }
        include $path;
    }

    /**
     * @param Exception $e
     * @return void
     * выводит ошибку в html разметке
     */
    public static function exception(Exception $e): void
    {
        //extract создаст переменные по названиям ключей со значением которое есть у ключа
        //помещаем ошибку и трассировку в переменные
        extract([
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);
        //путь до страницы HTML, выводящей ошибку
        $path = __DIR__ . "/../../../views/" . Config::get('app.exception_view') . ".view.php";
        //проверка существования пути
        if (!file_exists($path)) {
            echo $e->getMessage() . "<br><hr>";
            echo "<pre>{$e->getTraceAsString()}</pre>";
            return;
        }
        include $path;
    }

    /**
     * @throws ComponentNotFoundException
     */
    public static function component(string $component): void
    {
        $path = __DIR__ . "/../../../views/components/$component.component.php";
        if (!file_exists($path)) {
            throw new ComponentNotFoundException("Component ($component) not found");
        }
        include $path;
    }

    public static function error(string $code): void
    {
        $path = __DIR__ . "/../../../views/app/errors/$code.view.php";
        include $path;
    }
}