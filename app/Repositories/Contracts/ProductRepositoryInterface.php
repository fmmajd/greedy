<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function truncate(): void;

    public function createBy(string $name, int $price): void;
}
