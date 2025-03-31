<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $products = Product::all();

        foreach ($products as $product) {
            // Tạo 0-5 comment cho mỗi sản phẩm
            $commentCount = rand(0, 5);
            for ($i = 0; $i < $commentCount; $i++) {
                Comment::create([
                    'user_id' => $users->random()->id,
                    'product_id' => $product->id,
                    'content' => fake()->paragraph(),
                    'rating' => rand(3, 5),
                    'status' => true
                ]);
            }
        }
    }
}
