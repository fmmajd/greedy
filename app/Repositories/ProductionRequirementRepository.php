<?php

namespace App\Repositories;

use App\Models\ProductionRequirement;
use App\Repositories\Contracts\ProductionRequirementRepositoryInterface;

class ProductionRequirementRepository implements ProductionRequirementRepositoryInterface
{
    public function truncate(): void
    {
        ProductionRequirement::truncate();
    }

    public function createBy(int $productId, int $articleRefId, int $amount): void
    {
        $pr = new ProductionRequirement();
        $pr->product_id = $productId;
        $pr->article_ref = $articleRefId;
        $pr->amount = $amount;

        $pr->save();
    }
}
