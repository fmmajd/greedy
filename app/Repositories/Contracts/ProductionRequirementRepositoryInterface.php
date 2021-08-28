<?php

namespace App\Repositories\Contracts;

use App\Models\ProductionRequirement;

interface ProductionRequirementRepositoryInterface
{
    public function truncate(): void;

    public function createBy(int $productId, int $articleRefId, int $amount): void;

    /**
     * @return ProductionRequirement[]
     */
    public function fetchProductRequirementsWithArticles(int $productId): array;
}
