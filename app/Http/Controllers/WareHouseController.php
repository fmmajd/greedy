<?php

namespace App\Http\Controllers;

use App\Http\Requests\WareHouseRequest;
use App\Services\Validators\JsonValidatorFactory;
use Illuminate\Routing\Controller;

class WareHouseController extends Controller
{
    public function process(WareHouseRequest $request): void
    {
        $this->validateFiles($request);
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
}
