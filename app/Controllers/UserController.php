<?php

namespace App\Controllers;

use App\Application\Alerts\AlertInterface;
use App\Application\Request\Request;
use App\Application\Router\Redirect;
use App\Services\User\UserService;
use App\Application\Alerts\Alert;

class UserController
{

    private UserService $service;

    public function __construct()
    {
        $this->service = new UserService();

    }

    public function register(Request $request): void
    {
        $request->validation([
            'email' => ['required', 'email'],
            'name' => ['required'],
            'password' => ['required', 'password_confirm']
        ]);

        if (!$request->validationStatus()) {
            Alert::storeMessage('Проверьте правильность введенных полей', Alert::DANGER);
            Redirect::to('/register');
        }

        $this->service->register([
            'email' => $request->post('email'),
            'name' => $request->post('name'),
            'password' => $request->post('password'),
            'password_confirm' => $request->post('password_confirm'),
        ]);
        Alert::storeMessage('Регистрация прошла успешно. Авторизируйтесь.', Alert::SUCCESS);
        Redirect::to('/login');
    }

    public function login(Request $request): void
    {
        $request->validation([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (!$request->validationStatus()) {
            Alert::storeMessage('Проверьте правильность введенных полей', Alert::DANGER);
            Redirect::to('/login');
        }
        $auth = $this->service->login(
            $request->post('email'),
            $request->post('password')
        );

        if (!$auth) {
            Redirect::to('/login');
        } else {
            Redirect::to('/profile');
        }
    }

    public function logout(Request $request): void
    {
        $this->service->logout();
    }
}