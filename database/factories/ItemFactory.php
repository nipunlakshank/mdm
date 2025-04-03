<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::all();
        $brands = Brand::all();

        return [
            'code' => $this->faker->unique()->word(),
            'name' => $this->faker->word(),
            'attachment' => $this->faker->imageUrl(),
            'is_active' => $this->faker->boolean(75),
            'category_id' => $categories->random()->id,
            'brand_id' => $brands->random()->id,
        ];
    }
}
