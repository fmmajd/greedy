<?php

namespace App\Services\Strategies;

use App\DTOs\ProductQuantityDTO;
use App\Models\Product;

class GreedyStrategy implements Strategy
{
    public function decide(): void
    {
        $this->findTheMostProfitableProduct(Product::all()->all());
    }

    /**
     * @param Product[] $products
     */
    private function findTheMostProfitableProduct(array $products): ProductQuantityDTO
    {
        $dto = new ProductQuantityDTO();
        $max = 0;
        foreach ($products as $product) {
            $buildableProducts = $this->findMaximumBuildableProducts($product);
            $profit = $buildableProducts * $product->price;
            if ($profit > $max) {
                $dto->setProductId($product->id)
                    ->setQuantity($buildableProducts)
                    ->setProfit($profit);
                $max = $profit;
            }
        }

        return $dto;
    }

    private function findMaximumBuildableProducts(Product $product): int
    {
        $buildable = INF;
        foreach ($product->requirements as $requirement) {
            $articleAmount = $requirement->article->stock;
            $productArticleAmount = (int) ($articleAmount / $requirement->amount);
            if ($productArticleAmount < $buildable) {
                $buildable = $productArticleAmount;
            }
        }

        return $buildable;
    }
}
