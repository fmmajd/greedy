<?php

namespace Tests\Feature\App\Repositories;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductRepositoryTest extends TestCase
{
    use RefreshDatabase;

    private ProductRepository $productRepository;

    protected function setUp(): void
    {
        parent::setUp();

        $this->productRepository = app()->make(ProductRepository::class);
    }

    public function test_product_repository_should_create_new_product()
    {
        $this->productRepository->createBy('chair', 1000);

        $this->assertDatabaseHas('products', [
            'name' => 'chair',
            'price' => 1000,
        ]);
    }

    public function test_product_repository_should_find_products_by_name()
    {
        Product::factory()
            ->create([
                'name' => 'chair',
            ]);

        $foundProduct = $this->productRepository->findByName('chair');

        $this->assertEquals('chair', $foundProduct->name);
    }

    public function test_product_repository_should_find_products_except_ids()
    {
        Product::factory()
            ->count(5)
            ->sequence(fn ($sequence) => ['id' => ($sequence->index)+1])
            ->create();

        $res = $this->productRepository->findProductsExceptIdsWithRequirementsAndArticles([3, 4]);
        $this->assertCount(3, $res);
    }
}
