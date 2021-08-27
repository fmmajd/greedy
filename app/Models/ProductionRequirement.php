<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductionRequirement extends Model
{
    protected $table = 'production_requirements';

    protected $fillable = ['product_id', 'article_ref_id', 'amount'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class, 'article_ref_id', 'ref_id');
    }
}