<?php

namespace App\Services\Strategies;

use App\DTOs\ProductQuantityDTO;
use App\Models\Product;
use App\Repositories\Contracts\WarehouseItemRepositoryInterface;
use App\Services\Warehouse\WarehouseServiceInterface;

class GreedyStrategy implements Strategy
{
    public function __construct(
        private WarehouseItemRepositoryInterface $warehouseItemRepository,
        private WarehouseServiceInterface $warehouseService
    ) {}

    public function decide(): array
    {
        $this->warehouseItemRepository->truncate();

        $products = $this->warehouseService->findUnproducedProductsWithRequirementsAndArticles();
        $inventory = []; //variable to keep final products

        while(!empty($products)) {
            $productDTO = $this->findTheMostProfitableProduct($products);
            if ($productDTO->getProductId() === 0) {
                break;
            }
            $this->warehouseItemRepository->createBy($productDTO->getProductId(), $productDTO->getQuantity(), $productDTO->getProfit());
            $this->warehouseService->updateArticleStocksBaseOnNewWarehouseInventory($productDTO->getProductId(), $productDTO->getQuantity());

            $inventory[] = $productDTO;
            $products = $this->warehouseService->findUnproducedProductsWithRequirementsAndArticles();
        }

        return $inventory;
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
