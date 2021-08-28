<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property ProductionRequirement[] $requirements
 * @property int $id
 * @property int $price
 * @property string $name
 */
class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'price'];

    public function requirements(): HasMany
    {
        return $this->hasMany(ProductionRequirement::class);
    }
}
