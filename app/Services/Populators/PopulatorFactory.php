<?php

namespace App\Services\Populators;

use Exception;

class PopulatorFactory
{
    public const ARTICLES = 'articles';
    public const PRODUCTS = 'products';

    public static function make(string $type): JsonPopulator
    {
        switch ($type) {
            case self::ARTICLES:
                return app()->make(ArticlePopulator::class);

            
            default:
                throw new Exception('populator class for this type was not found');
        }
    }
}
