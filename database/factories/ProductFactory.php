<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2),
            'categories_id' => Category::factory(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'image' => null,
            'quantity' => $this->faker->numberBetween(0, 1000),
        ];
    }
}
