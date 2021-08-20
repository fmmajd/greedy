<?php

namespace App\Services\Validators;

use Illuminate\Support\Facades\Validator;

class ProductsJsonValidator implements JsonValidator
{
    public function validate(array $json): void
    {
        $validator = Validator::make($json, [
            'products' => 'required|array',
            'products.*.name' => 'required|string|distinct',
            'products.*.price' => 'required|numeric',
            'products.*.articles' => 'required|array',
            'products.articles.*.id' => 'required|numeric|distinct',
            'products.articles.*.amount' => 'required|numeric',
        ]);
        $validator->validate();
    }
}
