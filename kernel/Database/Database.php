<?php

namespace Application\Kernel\Database;

use PDO;

class Database implements DatabaseInterface
{
    private PDO $pdo;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->pdo = new PDO('mysql:host=localhost;port=5432;dbname=kinopoisk;charset=utf8');
    }

    public function insert(string $table, array $data): int|bool
    {
        // TODO: Implement insert() method.
    }
}