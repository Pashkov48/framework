<?php

namespace App\Application\Views;

use App\Application\Auth\Auth;
use App\Application\Router\Route;
use App\Application\Router\Router;
use App\Exceptions\ComponentNotFoundException;
use App\Exceptions\ViewNotFoundException;
use App\Application\Config\Config;

class App
{
    public function run(): void
    {
        //выполнение кода или вывод ошибок(если debug = true,
        try {
            $this->handle();
        } catch (ViewNotFoundException|ComponentNotFoundException|\PDOException $e) {
            //debug режим - выводит exception, иначе Error 500
            if (Config::get('app.debug')) {
                View::exception($e);
            } else {
                View::error(500);
            }
        }
    }

    private function handle(): void
    {
        //инициализация файлов с конфигурациями
        Config::init();
        //подключам маршрутизатор для формы contacts и др. страниц
        require_once __DIR__ . '/../../../routes/actions.php';
        require_once __DIR__ . '/../../../routes/pages.php';
        $router = new Router();
        Auth::init();
        $router->handle(Route::list());
    }
}