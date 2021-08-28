<?php

namespace App\Http\Resources;

use App\DTOs\ProductQuantityDTO;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    /**
     * @var ProductQuantityDTO[]
     */
    private array $inventory;

    public function __construct($inventory)
    {
        parent::__construct($inventory);
        $this->inventory = $inventory;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $totalProfit = 0;
        $products = [];
        foreach ($this->inventory as $item) {
            $totalProfit += $item->getProfit();
            $products[] = [
                'name' => $item->getProductName(),
                'quantity' => $item->getQuantity(),
            ];
        }
        return [
            'profit' => $totalProfit,
            'products' => $products,
        ];
    }
}
