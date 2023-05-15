<?php

use App\Application\Config\Config;
use App\Application\Views\View;
use App\Application\Alerts\Error;
use App\Application\Alerts\Alert;

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
    <h2 class="mb-4">Регистрация</h2>
    <form action="/register" method="post">
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
            <input type="text" name="email" class="form-control <?= Error::has('email') ? 'is-invalid' : '' ?>"
                   id="email" aria-describedby="emailHelp">
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?= Error::get('email'); ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" name="name" class="form-control <?= Error::has('name') ? 'is-invalid' : '' ?>" id="name"
                   aria-describedby="emailHelp">
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?= Error::get('name'); ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password"
                   class="form-control <?= Error::has('password') ? 'is-invalid' : '' ?>" id="password">
            <div id="validationServerUsernameFeedback" class="invalid-feedback">
                <?= Error::get('password'); ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="password_confirm" class="form-label">Подтверждение пароля</label>
            <input type="password" name="password_confirm"
                   class="form-control <?= Error::has('password') ? 'is-invalid' : '' ?>" id="password_confirm">
        </div>
        <p>Есть аккаунт? <a href="/login">Войти</a></p>
        <button type="submit" class="btn btn-success">Далее</button>
    </form>
</main>

</body>
</html>