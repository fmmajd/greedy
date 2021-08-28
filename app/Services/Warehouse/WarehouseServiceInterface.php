<?php

namespace App\Services\Warehouse;

use App\Models\Product;

interface WarehouseServiceInterface
{
    public function updateArticleStocksBaseOnNewWarehouseInventory(int $productId, int $quantity): void;

    /**
     * @return Product[]
     */
    public function findUnproducedProductsWithRequirementsAndArticles(): array;
}
