<?php

namespace App\Services\Populators;

use App\Repositories\Contracts\ProductionRequirementRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductionRequirementPopulator implements JsonPopulator
{
    public function __construct(
        private ProductionRequirementRepositoryInterface $productionRequirementRepository,
        private ProductRepositoryInterface $productRepository
    ) {}

    public function populateFromJson(array $json)
    {
        $this->productionRequirementRepository->truncate();

        foreach ($json['products'] as $product) {
            $productId =  $this->productRepository->findByName($product['name'])->id;
            foreach ($product['articles'] as $requirement) {
                $articleRefId = $requirement['id'];
                $amount = $requirement['amount'];
                $this->productionRequirementRepository->createBy($productId, $articleRefId, $amount);
            }
        }
    }
}
