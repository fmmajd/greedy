<?php

namespace App\Http\Controllers;

use App\Http\Requests\WareHouseRequest;
use App\Http\Resources\InventoryResource;
use App\Services\Populators\PopulatorFactory;
use App\Services\Strategies\Strategy;
use App\Services\Validators\JsonValidatorFactory;
use Illuminate\Routing\Controller;

class WareHouseController extends Controller
{
    public function __construct(
        private Strategy $strategy
    ) {}

    public function process(WareHouseRequest $request)
    {
        $this->validateFiles($request);

        $this->populateModels($request);

        $inventory = $this->strategy->decide();

        return (new InventoryResource($inventory));
    }

    private function validateFiles(WareHouseRequest $request): void
    {
        $products = json_decode(file_get_contents($request->file('products')), true);
        $articles = json_decode(file_get_contents($request->file('articles')), true);

        $productsValidator = JsonValidatorFactory::make(
            JsonValidatorFactory::PRODUCTS
        );
        $productsValidator->validate($products);

        $articlesValidator = JsonValidatorFactory::make(
            JsonValidatorFactory::ARTICLES
        );
        $articlesValidator->validate($articles);
    }

    private function populateModels(WareHouseRequest $request): void
    {
        $products = json_decode(file_get_contents($request->file('products')), true);
        $articles = json_decode(file_get_contents($request->file('articles')), true);

        $articlesPopulator = PopulatorFactory::make(PopulatorFactory::ARTICLES);
        $articlesPopulator->populateFromJson($articles);

        $productsPopulator = PopulatorFactory::make(PopulatorFactory::PRODUCTS);
        $productsPopulator->populateFromJson($products);

        $requirementsPopulator = PopulatorFactory::make(PopulatorFactory::PRODUCT_REQUIREMENTS);
        $requirementsPopulator->populateFromJson($products);
    }
}
