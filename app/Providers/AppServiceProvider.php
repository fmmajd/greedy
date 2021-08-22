<?php

namespace App\Providers;

use App\Repositories\ArticlesRepository;
use App\Repositories\Contracts\ArticlesRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $bindings = [
        ArticlesRepositoryInterface::class => ArticlesRepository::class,
        ProductRepositoryInterface::class => ProductRepository::class,
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
