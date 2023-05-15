<?php

namespace App\Application\Router;

use App\Application\Views\View;

class Router implements RouterInterface
{
    use RouterHelper;

    public function handle(array $routes): void
    {
        //получаем URL и метод
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        $uri = $_SERVER["REQUEST_URI"];
        //если метод POST(клик на форме), то переменная type post, иначе page
        $type = $requestMethod === 'POST' ? 'post' : 'page';
        //фильтруем массив со всеми роутами по типу
        $filteredRoutes = self::filter($routes, $type);
        //перебираем, если URI совпадает, то выполянем метод
        foreach ($filteredRoutes as $route) {
            if ($route['uri'] === $uri) {
                if (!empty($route['middleware'])) {
                    $middleware = new $route['middleware']();
                    $middleware->handle();
                }
                self::controller($route);
                return;
            }
        }
        View::error(404);
    }
}