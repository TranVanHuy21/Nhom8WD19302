<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            // Tạo 10 sản phẩm cho mỗi danh mục
            Product::factory()->count(10)->create([
                'category_id' => $category->id
            ])->each(function ($product) {
                // Tạo 3 ảnh cho mỗi sản phẩm
                for ($i = 0; $i < 3; $i++) {
                    ProductImage::create([
                        'product_id' => $product->id,
                        'url' => fake()->imageUrl(640, 480, 'products'),
                        'is_primary' => $i === 0
                    ]);
                }
            });
        }
    }
}