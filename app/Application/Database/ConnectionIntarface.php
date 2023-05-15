<?php

namespace App\Application\Database;

interface ConnectionIntarface
{
    public function connect(): \PDO;
}