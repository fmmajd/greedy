<?php

namespace App\Repositories\Contracts;

use App\Models\Product;

interface ProductRepositoryInterface
{
    public function truncate(): void;

    public function createBy(string $name, int $price): void;

    public function findByName(string $name): ?Product;
}
