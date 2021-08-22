<?php

namespace App\Services\Populators;

use App\Repositories\Contracts\ArticlesRepositoryInterface;

class ArticlePopulator implements JsonPopulator
{
    public function __construct(
        private ArticlesRepositoryInterface $articleRepository
    ) {}

    public function populateFromJson(array $json)
    {
        $this->articleRepository->truncate();
        foreach ($json['articles'] as $article) {
            $refId = $article['id'];
            $name = $article['name'];
            $stock = $article['stock'];
            $this->articleRepository->createBy($refId, $name, $stock);
        }
    }
}
