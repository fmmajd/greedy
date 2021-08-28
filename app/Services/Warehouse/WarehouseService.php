<?php

namespace App\Services\Warehouse;

use App\Repositories\Contracts\ArticlesRepositoryInterface;
use App\Repositories\Contracts\ProductionRequirementRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\WarehouseItemRepositoryInterface;

class WarehouseService implements WarehouseServiceInterface
{
    public function __construct(
        private ArticlesRepositoryInterface $articlesRepository,
        private ProductionRequirementRepositoryInterface $productionRequirementRepository,
        private ProductRepositoryInterface $productRepository,
        private WarehouseItemRepositoryInterface $warehouseItemRepository
    ) {}

    public function updateArticleStocksBaseOnNewWarehouseInventory(int $productId, int $quantity): void
    {
        $requirements = $this->productionRequirementRepository->fetchProductRequirementsWithArticles($productId);
        foreach ($requirements as $requirement) {
            $amount = $requirement->amount * $quantity;
            $article = $requirement->article;
            $this->articlesRepository->updateStock($article, $article->stock - $amount);
        }
    }

    public function findUnproducedProductsWithRequirementsAndArticles(): array
    {
        $warehouseProductIds = $this->warehouseItemRepository->allProductIds();
        return $this->productRepository->findProductsExceptIdsWithRequirementsAndArticles($warehouseProductIds);
    }
}
