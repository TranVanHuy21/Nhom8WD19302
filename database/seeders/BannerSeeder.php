<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 5; $i++) {
            Banner::create([
                'title' => 'Banner quảng cáo ' . $i,
                'image' => fake()->imageUrl(1200, 400, 'banner'),
                'link' => fake()->url,
                'position' => $i,
                'status' => true
            ]);
        }
    }
}
