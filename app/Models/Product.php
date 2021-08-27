<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'price'];

    public function productionRequirements(): HasMany
    {
        return $this->hasMany(ProductionRequirement::class);
    }
}
