<?php

namespace App\Services\Strategies;

use App\DTOs\ProductQuantityDTO;

interface Strategy
{
    /**
     * @return ProductQuantityDTO[]
     */
    public function decide(): array;
}
