<?php

namespace Tests\Unit\App\Services\Warehouse;

use App\Models\Article;
use App\Models\Product;
use App\Models\ProductionRequirement;
use App\Repositories\Contracts\ArticlesRepositoryInterface;
use App\Repositories\Contracts\ProductionRequirementRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\WarehouseItemRepositoryInterface;
use App\Services\Warehouse\WarehouseService;
use Mockery\MockInterface;
use Tests\TestCase;

class WarehouseServiceTest extends TestCase
{
    public function test_warehouse_service_should_update_article_stocks_based_on_new_warehouse_inventory()
    {
        $productId = 1;

        $articleRepoMock = $this->mock(
            ArticlesRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('updateStock')
                    ->once();
            }
        );

        $productionRequirementRepoMock = $this->mock(
            ProductionRequirementRepositoryInterface::class,
            function (MockInterface $mock) use ($productId) {
                $productionRequirement = ProductionRequirement::factory()
                    ->for(Product::factory())
                    ->for(Article::factory())
                    ->make();
                $mock->shouldReceive('fetchProductRequirementsWithArticles')
                    ->once()
                    ->with($productId)
                    ->andReturn([$productionRequirement]);
            }
        );

        $productRepoMock = $this->mock(ProductRepositoryInterface::class);
        $warehouseItemRepo = $this->mock(WarehouseItemRepositoryInterface::class);

        $warehouseService = new WarehouseService(
            $articleRepoMock,
            $productionRequirementRepoMock,
            $productRepoMock,
            $warehouseItemRepo
        );
        $warehouseService->updateArticleStocksBaseOnNewWarehouseInventory(
            $productId,
            2
        );
    }

    public function test_warehouse_service_should_find_unproduced_products()
    {
        $articleRepoMock = $this->mock(ArticlesRepositoryInterface::class);
        $productionRequirementRepoMock = $this->mock(ProductionRequirementRepositoryInterface::class);

        $productRepoMock = $this->mock(
            ProductRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('findProductsExceptIdsWithRequirementsAndArticles')
                    ->once()
                    ->with([1,2,3]);
            }
        );

        $warehouseItemRepo = $this->mock(
            WarehouseItemRepositoryInterface::class,
            function (MockInterface $mock) {
                $mock->shouldReceive('allProductIds')
                    ->once()
                    ->andReturn([1,2,3]);
            }
        );

        $warehouseService = new WarehouseService(
            $articleRepoMock,
            $productionRequirementRepoMock,
            $productRepoMock,
            $warehouseItemRepo
        );

        $warehouseService->findUnproducedProductsWithRequirementsAndArticles();
    }
}
