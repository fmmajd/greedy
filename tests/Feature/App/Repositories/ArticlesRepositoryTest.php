<?php

namespace Tests\Feature\App\Repositories;

use App\Models\Article;
use App\Repositories\ArticlesRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlesRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private ArticlesRepository $articleRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->articleRepository = app()->make(ArticlesRepository::class);
    }

    public function test_article_repository_should_create_new_article()
    {
        $this->articleRepository->createBy(
            1,
            'screw',
            10
        );

        $this->assertDatabaseHas('articles', [
            'ref_id' => 1,
            'name' => 'screw',
            'stock' => 10,
        ]);
    }

    public function test_article_repository_should_update_stocks()
    {
        $article = Article::factory()->create([
            'ref_id' => 1,
            'stock' => 20,
        ]);

        $this->articleRepository->updateStock($article, 10);

        $this->assertDatabaseHas('articles', [
            'ref_id' => 1,
            'stock' => 10,
        ]);
    }
}
