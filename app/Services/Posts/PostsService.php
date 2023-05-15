<?php

namespace App\Services\Posts;

use App\Application\Alerts\Alert;
use App\Application\Auth\Auth;
use App\Application\Router\Redirect;
use App\Application\Upload\Upload;
use App\Models\Post;

class PostsService implements PostsServiceInterface
{
    public function store(array $image, ?string $description): void
    {
        if ($image = Upload::file($image, 'images')) {
            $post = new Post();
            $post->setImage($image);
            $post->setDescription($description);
            $post->setUser(Auth::id());
            $post->store();
        } else {
            Alert::storeMessage('Ошибка при загрузке изображения', Alert::DANGER);
        }
        Redirect::to('/profile');
    }

    public
    function destroy(int $id): void
    {
        // TODO: Implement destroy() method.
    }
}