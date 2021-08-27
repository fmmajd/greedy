<?php

namespace App\Repositories\Contracts;

interface ProductionRequirementRepositoryInterface
{
    public function truncate(): void;

    public function createBy(int $productId, int $articleRefId, int $amount): void;
}
