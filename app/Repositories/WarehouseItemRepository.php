<?php

namespace App\Repositories;

use App\Models\WarehouseItem;
use App\Repositories\Contracts\WarehouseItemRepositoryInterface;

class WarehouseItemRepository implements WarehouseItemRepositoryInterface
{
    public function truncate(): void
    {
        WarehouseItem::truncate();
    }

    public function createBy(int $productId, int $quantity, int $profit): void
    {
        $item = new WarehouseItem([
            'product_id' => $productId,
            'quantity' => $quantity,
            'profit' => $profit,
        ]);

        $item->save();
    }

    public function allProductIds(): array
    {
        return WarehouseItem::pluck('product_id')->all();
    }
}
