<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    public function truncate(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Product::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function createBy(string $name, int $price): void
    {
        $product = new Product([
            'name' => $name,
            'price' => $price,
        ]);

        $product->save();
    }

    public function findByName(string $name): ?Product
    {
        return Product::where('name', $name)->first();
    }
}
