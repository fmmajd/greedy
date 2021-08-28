<?php

namespace App\DTOs;

class ProductQuantityDTO
{
    private int $productId = 0;

    private int $quantity = 0;

    private int $profit = 0;

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): ProductQuantityDTO
    {
        $this->productId = $productId;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): ProductQuantityDTO
    {
        $this->quantity = $quantity;
        return $this;
    }

    public function getProfit(): int
    {
        return $this->profit;
    }

    public function setProfit(int $profit): ProductQuantityDTO
    {
        $this->profit = $profit;
        return $this;
    }
}
