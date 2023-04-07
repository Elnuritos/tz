<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_categories()
    {
        Category::factory()->count(5)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200);
        $response->assertJsonCount(5);
    }

    public function test_update_changes_category_fields()
    {
        $category = Category::factory()->create();
        $newParent = Category::factory()->create();

        $response = $this->putJson("/api/categories/{$category->id}", [
            'parent_id' => $newParent->id,
            'index' => 50,
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'parent_id' => $newParent->id,
            'index' => 50,
        ]);
    }
}
