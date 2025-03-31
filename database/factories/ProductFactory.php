<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition(): array
    {
        $name = fake()->words(3, true);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(),
            'price' => fake()->numberBetween(100000, 50000000),
            'sale_price' => fake()->optional(0.3)->numberBetween(90000, 45000000),
            'quantity' => fake()->numberBetween(0, 100),
            'category_id' => rand(1, 12), // Số này phụ thuộc vào số danh mục trong CategorySeeder
            'image' => fake()->imageUrl(640, 480, 'products'),
            'status' => true,
            'featured' => fake()->boolean(20)
        ];
    }
}
