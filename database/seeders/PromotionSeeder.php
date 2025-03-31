<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo mã giảm giá cố định
        Promotion::create([
            'name' => 'Giảm 50K',
            'code' => 'GIAM50K',
            'type' => 'fixed',
            'value' => 50000,
            'max_uses' => 100,
            'start_date' => now(),
            'end_date' => now()->addMonths(1),
        ]);

        // Tạo mã giảm giá phần trăm
        Promotion::create([
            'name' => 'Giảm 10%',
            'code' => 'GIAM10PT',
            'type' => 'percent',
            'value' => 10,
            'max_uses' => 100,
            'start_date' => now(),
            'end_date' => now()->addMonths(1),
        ]);
    }
}
