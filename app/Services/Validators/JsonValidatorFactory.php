<?php

namespace App\Services\Validators;

use Exception;

class JsonValidatorFactory
{
    public const ARTICLES = 'articles';
    public const PRODUCTS = 'products';

    public static function make(string $type): JsonValidator
    {
        switch ($type) {
            case self::ARTICLES:
                return new ArticlesJsonValidator();

            case self::PRODUCTS:
                return new ProductsJsonValidator();
            
            default:
                throw new Exception('validator class for this json type was not found');
        }
    }
}
