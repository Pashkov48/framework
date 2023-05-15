<?php

use App\Application\Router\Route;
use App\Controllers\PagesController;
use App\Middleware\GuestMiddleware;

//вызываем метод page, который сохраняет а один массив все страницы и другие данные
Route::page('/', PagesController::class, 'index');
Route::page('/login', PagesController::class, 'login', GuestMiddleware::class);
Route::page('/register', PagesController::class, 'register', GuestMiddleware::class);
Route::page('/profile', PagesController::class, 'profile');



