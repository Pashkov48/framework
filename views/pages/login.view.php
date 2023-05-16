<?php

use App\Application\Config\Config;
use App\Application\Views\View;
use App\Application\Alerts\Alert;
use App\Application\Alerts\Error;

?>

<!doctype html>
<html lang="<?= Config::get('app.lang') ?>">
<head>
    <?php View::component('head'); ?>
    <title><?= $title ?></title>
</head>
<body>
<main class="main">
    <?php View::component('nav'); ?>
    <h2 class="mb-4">Вход</h2>
    <form method="post" action="/login">

        <?php
        if (Alert::success()) {
            ?>
            <div class="alert alert-success" role="alert">
                <?= Alert::success(true) ?>
            </div>
            <?php
        }
        ?>

        <?php
        if (Alert::danger()) {
            ?>
            <div class="alert alert-danger" role="alert">
                <?= Alert::danger(true) ?>
            </div>
            <?php
        }
        ?>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control <?= Error::has('email') ? 'is-invalid' : '' ?>"
                   id="email" aria-describedby="emailHelp">
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?= Error::get('email'); ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password"
                   class="form-control <?= Error::has('password') ? 'is-invalid' : '' ?>"
                   id="password">
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?= Error::get('password'); ?>
            </div>
        </div>
        <p>Нет аккаунта? <a href="/register">Регистрация</a></p>
        <button type="submit" class="btn btn-primary mt-3">Войти</button>
    </form>
</main>
</body>
</html>