<?php

namespace App\Services\Populators;

use Exception;

class PopulatorFactory
{
    public const ARTICLES = 'articles';
    public const PRODUCTS = 'products';
    public const PRODUCT_REQUIREMENTS = 'requirements';

    public static function make(string $type): JsonPopulator
    {
        switch ($type) {
            case self::ARTICLES:
                return app()->make(ArticlePopulator::class);

            case self::PRODUCTS:
                return app()->make(ProductPopulator::class);

            case self::PRODUCT_REQUIREMENTS:
                return app()->make(ProductionRequirementPopulator::class);

            default:
                throw new Exception('populator class for this type was not found');
        }
    }
}
