<?php

namespace App\Repositories;

use App\Models\Article;
use App\Repositories\Contracts\ArticlesRepositoryInterface;

class ArticlesRepository implements ArticlesRepositoryInterface
{
    public function truncate(): void
    {
        Article::truncate();
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
