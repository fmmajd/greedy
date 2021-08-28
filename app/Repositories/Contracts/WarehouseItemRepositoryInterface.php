<?php

namespace App\Repositories\Contracts;

interface WarehouseItemRepositoryInterface
{
    public function truncate(): void;

    public function createBy(int $productId, int $quantity, int $profit): void;
}
