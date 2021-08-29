<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $stock
 */
class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';

    protected $fillable = ['ref_id', 'name', 'stock'];
}
