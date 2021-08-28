<?php

namespace App\Services\Warehouse;

interface WarehouseServiceInterface
{
    public function updateArticleStocksBaseOnNewWarehouseInventory(int $productId, int $quantity): void;
}
