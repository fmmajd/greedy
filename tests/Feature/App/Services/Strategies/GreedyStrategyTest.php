<?php

namespace Tests\Feature\App\Services\Strategies;

use App\DTOs\ProductQuantityDTO;
use App\Models\Article;
use App\Models\Product;
use App\Models\ProductionRequirement;
use App\Services\Strategies\GreedyStrategy;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Tests\TestCase;

class GreedyStrategyTest extends TestCase
{
    private GreedyStrategy $strategy;

    protected function setUp(): void
    {
        parent::setUp();

        $this->strategy = app()->make(GreedyStrategy::class);
    }

    public function test_greedy_strategy_should_find_the_best_decision()
    {
        $this->prepareData();

        $res = $this->strategy->decide();

        $this->assertIsArray($res);;
        $this->assertCount(2, $res);

        $firstProduct = $res[0];
        $this->assertInstanceOf(ProductQuantityDTO::class, $firstProduct);
        $this->assertEquals('Dining Chair', $firstProduct->getProductName());
        $this->assertEquals(2, $firstProduct->getQuantity());
        $this->assertEquals(2000, $firstProduct->getProfit());

        $secondProduct = $res[1];
        $this->assertInstanceOf(ProductQuantityDTO::class, $secondProduct);
        $this->assertEquals('Dining Table', $secondProduct->getProductName());
        $this->assertEquals(1, $secondProduct->getQuantity());
        $this->assertEquals(1100, $secondProduct->getProfit());
    }

    private function prepareData()
    {
        $articles = Article::factory()
            ->count(4)
            ->state(new Sequence(
                [
                    'ref_id' => 1,
                    'name' => 'leg',
                    'stock' => 12,
                ],
                [
                    'ref_id' => 2,
                    'name' => 'screw',
                    'stock' => 17,
                ],
                [
                    'ref_id' => 3,
                    'name' => 'seat',
                    'stock' => 3,
                ],
                [
                    'ref_id' => 4,
                    'name' => 'table top',
                    'stock' => 1,
                ]
            ))
            ->create();

        $products = Product::factory()
            ->count(2)
            ->state(new Sequence(
                [
                    'name' => 'Dining Chair',
                    'price' => 1000,
                ],
                [
                    'name' => 'Dining Table',
                    'price' => 1100,
                ]
            ))
            ->create();

        ProductionRequirement::factory()
            ->for($products[0])
            ->for($articles[0])
            ->create([
                'amount' => 4,
            ]);
        ProductionRequirement::factory()
            ->for($products[0])
            ->for($articles[1])
            ->create([
                'amount' => 8,
            ]);
        ProductionRequirement::factory()
            ->for($products[0])
            ->for($articles[2])
            ->create([
                'amount' => 1,
            ]);

        ProductionRequirement::factory()
            ->for($products[1])
            ->for($articles[0])
            ->create([
                'amount' => 4,
            ]);
        ProductionRequirement::factory()
            ->for($products[1])
            ->for($articles[1])
            ->create([
                'amount' => 1,
            ]);
        ProductionRequirement::factory()
            ->for($products[1])
            ->for($articles[3])
            ->create([
                'amount' => 1,
            ]);
    }
}
