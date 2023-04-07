<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition()
    {

        return [
            'name' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->paragraph(),
            'category_id' => Category::inRandomOrder()->first()?->id,
        ];
    }
}
