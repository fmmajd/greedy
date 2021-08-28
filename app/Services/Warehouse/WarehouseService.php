<?php

namespace App\Services\Warehouse;

use App\Repositories\Contracts\ArticlesRepositoryInterface;
use App\Repositories\Contracts\ProductionRequirementRepositoryInterface;

class WarehouseService implements WarehouseServiceInterface
{
    public function __construct(
        private ArticlesRepositoryInterface $articlesRepository,
        private ProductionRequirementRepositoryInterface $productionRequirementRepository
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
}
