<?php

namespace App\Http\Controllers;

use App\Http\Requests\WareHouseRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

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

        $productsValidator = Validator::make($products, [
            'products' => 'required|array',
            'products.*.name' => 'required|string|distinct',
            'products.*.price' => 'required|numeric',
            'products.*.articles' => 'required|array',
            'products.articles.*.id' => 'required|numeric|distinct',
            'products.articles.*.amount' => 'required|numeric',
        ]);
        $productsValidator->validate();

        $articlesValidator = Validator::make($articles, [
            'articles' => 'required|array',
            'articles.*.id' => 'required|numeric|distinct',
            'articles.*.name' => 'required|string|distinct',
            'articles.*.stock' => 'required|numeric',
        ]);
        $articlesValidator->validate();
    }
}
