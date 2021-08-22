<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function truncate(): void
    {
        Product::truncate();
    }

    public function createBy(string $name, int $price): void
    {
        $product = new Product([
            'name' => $name, 
            'price' => $price,
        ]);

        $product->save();
    }
}
