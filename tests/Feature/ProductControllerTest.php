<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Category::create([
            'name' => 'Test Category',
            'parent_id' => null,
            'index' => 0
        ]);
    }

    public function test_index_returns_products()
    {
        Product::factory()->count(5)->create();

        $response = $this->getJson('/api/products');

        $response->assertStatus(200);

    }

    public function test_index_sorts_products_by_name()
    {
        Product::factory()->create(['name' => 'Apple']);
        Product::factory()->create(['name' => 'Banana']);
        Product::factory()->create(['name' => 'Cherry']);

        $response = $this->getJson('/api/products?sort=name_asc');

        $response->assertStatus(200);
    }
}
