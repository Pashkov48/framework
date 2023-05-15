<?php

namespace App\Controllers;

use App\Application\Request\Request;
use App\Services\Posts\PostsService;

class PostsController
{
    private PostsService $service;

    public function __construct()
    {
        $this->service = new PostsService();
    }

    public function publish(Request $request): void
    {
        $this->service->store($request->files('image'), $request->post('description'));
    }
}