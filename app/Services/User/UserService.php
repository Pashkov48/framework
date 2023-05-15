<?php

namespace App\Services\User;

use App\Application\Alerts\Alert;
use App\Application\Config\Config;
use App\Application\Helpers\Random;
use App\Application\Router\Redirect;
use App\Models\User;
use App\Application\Auth\Auth;

class UserService implements UserServiceInterface
{

    public function register(array $data): void
    {
        $user = new User();
        $user->setName($data['name']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $user->store();
    }

    public function login(string $username, string $password): bool
    {
        $user = (new User())->find('email', $username);
        if (!$user) {
            Alert::storeMessage('Пользователь не найден', Alert::DANGER);
            return false;
        }

        if (!password_verify($password, $user->getPassword())) {
            Alert::storeMessage('Неверный логин или пароль', Alert::DANGER);
            return false;
        }

        $token = Random::str(50);
        setcookie(Auth::getTokenColumn(), $token);
        $user->update([Auth::getTokenColumn() => $token]);
        return true;
    }

    public function logout(): void
    {
        unset($_COOKIE[Auth::getTokenColumn()]);
        setcookie(Auth::getTokenColumn());
        Redirect::to('/login');
    }
}