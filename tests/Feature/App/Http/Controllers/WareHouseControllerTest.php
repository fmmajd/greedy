<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Http\UploadedFile;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class WareHouseControllerTest extends TestCase
{
    public function test_warehouse_route_should_return_ok()
    {
        $response = $this->getResponse();

        $response->assertStatus(200);
    }

    public function test_warehouse_route_should_return_correct_inventory()
    {
        $response = $this->getResponse();

        $response->assertJson([
            'data' => [
                'profit' => 2000,
                'products' => [
                    [
                        'name' => 'Dining Chair',
                        'quantity' => 2,
                    ]
                ],
            ],
        ]);
    }

    private function getResponse(): TestResponse
    {
        $articlesPath = __DIR__ . '/stubs/articles.json';
        $articles = new UploadedFile(
            $articlesPath,
            'articles.json',
            'json',
            null,
            true
        );

        $productsPath = __DIR__ . '/stubs/products.json';
        $products = new UploadedFile(
            $productsPath,
            'products.json',
            'json',
            null,
            true
        );

        return $this->post('/api/warehouse', [
            'articles' => $articles,
            'products' => $products,
        ]);
    }
}
