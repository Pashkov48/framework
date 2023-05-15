<?php

use App\Application\Config\Config;
use App\Application\Views\View;
use App\Application\Alerts\Alert;
use App\Models\Post;
use App\Application\Auth\Auth;

$user = Auth::user();
$posts = (new Post())->find('user_id', $user->id(), true);

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
    <h2 class="mb-4"><?= $pageTitle ?></h2>
    <div class="profile">
        <img src="/assets/img/avatar.png" class="profile__avatar" alt="Аватар">
        <div class="profile__info">
            <h5 class="profile__info--name"><?= $user->getName(); ?></h5>
            <p class="profile__info--email"><?= $user->getEmail(); ?></p>
            <p class="profile__info--registered">Дата регистрации: <?= $user->createdAt(); ?></p>
        </div>
    </div>
    <hr>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Опубликовать
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                <form action="/post/publish" method="post" enctype="multipart/form-data">
                    <?php
                    if (Alert::danger()) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?= Alert::danger(true) ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="mb-3 mt-3">
                        <label for="image" class="form-label">Изображение</label>
                        <input class="form-control" name="image" type="file" id="image">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Описание</label>
                        <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Опубликовать</button>
                </form>
            </div>
        </div>
    </div>
    <hr>
    <h5 class="mt-1 mb-3">Мои публикации</h5>
    <div class="row row-cols-1 mb-3 row-cols-md-3 g-4 posts">
        <?php
        foreach ($posts as $post) {
            ?>
            <div class="col">
                <div class="card">
                    <img src="<?= $post->getImage(); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text"><?= $post->getDescription(); ?></p>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</main>

</body>
</html>