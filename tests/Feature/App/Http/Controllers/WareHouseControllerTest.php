<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class WareHouseControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_warehouse_route_should_return_ok()
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

        $response = $this->post('/api/warehouse', [
            'articles' => $articles,
            'products' => $products,
        ]);

        $response->assertStatus(200);
    }
}
