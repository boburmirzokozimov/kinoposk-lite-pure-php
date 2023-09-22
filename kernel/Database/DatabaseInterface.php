<?php

namespace Application\Kernel\Database;

interface DatabaseInterface
{
    public function insert(string $table, array $data): int|bool;
}