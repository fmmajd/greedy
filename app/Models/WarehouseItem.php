<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WarehouseItem extends Model
{
    protected $table = 'warehouse';

    protected $fillable = ['product_id', 'quantity', 'profit'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
