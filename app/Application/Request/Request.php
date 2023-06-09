<?php

namespace App\Application\Request;
//принимает в себя данные из POST, GET, FILES
class Request implements RequestInterface
{
    use RequestValidation;

    private array $post;
    private array $get;
    private array $files;

    public function __construct(array $post, array $get, array $files)
    {
        $this->post = $post;
        $this->get = $get;
        $this->files = $files;
    }


    public function get(string $key): mixed
    {
        return $this->get[$key] ?? NULL;
    }

    public function post(string $key): mixed
    {
        return $this->post[$key] ?? NULL;

    }

    public function files(string $key): mixed
    {
        return $this->files[$key] ?? NULL;
    }

    public function validation(array $rules): array|bool
    {
       return $this->validate(
            $this->post,
            $rules
        );
    }
}