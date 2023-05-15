<?php

namespace App\Application\Request;

interface RequestInterface
{
    public function get(string $key): mixed;

    public function post(string $key): mixed;

    public function files(string $key): mixed;

    public function validation(array $rules): array|bool;

}