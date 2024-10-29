<?php

namespace Database\Factories;

use App\Models\ProductSize;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductSize>
 */
class ProductSizeFactory extends Factory
{
    protected $model = ProductSize::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => \App\Models\Product::factory(),
            'size_name' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
