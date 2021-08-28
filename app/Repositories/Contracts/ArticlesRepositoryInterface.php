<?php

namespace App\Repositories\Contracts;

use App\Models\Article;

interface ArticlesRepositoryInterface
{
    public function truncate(): void;

    public function createBy(int $refId, string $name, int $stock): void;

    public function updateStock(Article $article, int $newStock): void;
}
