<?php

namespace App\Services\Validators;

use Illuminate\Support\Facades\Validator;

class ArticlesJsonValidator implements JsonValidator
{
    public function validate(array $json): void
    {
        $validator = Validator::make($json, [
            'articles' => 'required|array',
            'articles.*.id' => 'required|numeric|distinct',
            'articles.*.name' => 'required|string|distinct',
            'articles.*.stock' => 'required|numeric',
        ]);
        $validator->validate();
    }
}
