<?php

namespace App\Providers;

use App\Repositories\ArticlesRepository;
use App\Repositories\Contracts\ArticlesRepositoryInterface;
use App\Repositories\Contracts\ProductionRequirementRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\WarehouseItemRepositoryInterface;
use App\Repositories\ProductionRequirementRepository;
use App\Repositories\ProductRepository;
use App\Repositories\WarehouseItemRepository;
use App\Services\Strategies\GreedyStrategy;
use App\Services\Strategies\Strategy;
use App\Services\Warehouse\WarehouseService;
use App\Services\Warehouse\WarehouseServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        ArticlesRepositoryInterface::class => ArticlesRepository::class,
        ProductRepositoryInterface::class => ProductRepository::class,
        ProductionRequirementRepositoryInterface::class => ProductionRequirementRepository::class,
        WarehouseItemRepositoryInterface::class => WarehouseItemRepository::class,
        Strategy::class => GreedyStrategy::class,
        WarehouseServiceInterface::class => WarehouseService::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
