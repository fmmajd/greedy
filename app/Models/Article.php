<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $stock
 */
class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = ['ref_id', 'name', 'stock'];
}
