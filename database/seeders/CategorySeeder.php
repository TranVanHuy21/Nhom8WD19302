<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Điện thoại' => [
                'Điện thoại iPhone',
                'Điện thoại Samsung',
                'Điện thoại Xiaomi',
            ],
            'Laptop' => [
                'Laptop Gaming',
                'Laptop Văn phòng',
                'Macbook',
            ],
            'Tablet' => [
                'iPad',
                'Samsung Tablet',
                'Xiaomi Tablet',
            ],
            'Phụ kiện' => [
                'Tai nghe',
                'Sạc dự phòng',
                'Ốp lưng',
            ],
        ];

        foreach ($categories as $main => $subs) {
            $mainCat = Category::create([
                'name' => $main,
                'slug' => str()->slug($main),
                'description' => fake()->sentence(),
                'status' => true
            ]);

            foreach ($subs as $sub) {
                Category::create([
                    'name' => $sub,
                    'slug' => str()->slug($sub),
                    'description' => fake()->sentence(),
                    'parent_id' => $mainCat->id,
                    'status' => true
                ]);
            }
        }
    }
}
