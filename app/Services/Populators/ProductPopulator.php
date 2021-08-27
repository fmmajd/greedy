<?php

namespace App\Services\Populators;

use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductPopulator implements JsonPopulator
{
    public function __construct(
        private ProductRepositoryInterface $productRepository
    ) {}

    public function populateFromJson(array $json)
    {
        $this->productRepository->truncate();

        foreach ($json['products'] as $product) {
            $name = $product['name'];
            $price = $product['price'];
            $this->productRepository->createBy($name, $price);
        }
    }
}
