<?php

namespace App\Repositories;

use App\Models\Article;
use App\Repositories\Contracts\ArticlesRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ArticlesRepository implements ArticlesRepositoryInterface
{
    public function truncate(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Article::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function createBy(int $refId, string $name, int $stock): void
    {
        $article = new Article([
            'ref_id' => $refId,
            'name' => $name,
            'stock' => $stock,
        ]);

        $article->save();
    }
}
