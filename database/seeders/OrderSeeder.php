<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::where('role', 'user')->get();
        $products = Product::all();

        foreach ($users as $user) {
            // Tạo 1-3 đơn hàng cho mỗi user
            for ($i = 0; $i < rand(1, 3); $i++) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'order_number' => 'ORD-' . strtoupper(uniqid()),
                    'total_amount' => 0,
                    'status' => fake()->randomElement(['pending', 'processing', 'completed', 'cancelled']),
                    'payment_method' => fake()->randomElement(['cod', 'banking']),
                    'payment_status' => fake()->randomElement(['pending', 'paid']),
                    'shipping_name' => $user->name,
                    'shipping_phone' => $user->phone ?? fake()->phoneNumber(),
                    'shipping_address' => $user->address ?? fake()->address(),
                ]);

                // Thêm 1-5 sản phẩm vào đơn hàng
                $total = 0;
                for ($j = 0; $j < rand(1, 5); $j++) {
                    $product = $products->random();
                    $quantity = rand(1, 3);
                    $price = $product->sale_price ?? $product->price;

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $price
                    ]);

                    $total += $price * $quantity;
                }

                $order->update(['total_amount' => $total]);
            }
        }
    }
}
