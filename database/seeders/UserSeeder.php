<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo 20 user thông thường
        User::factory()->count(20)->create([
            'role' => 'user',
            'email_verified_at' => now()
        ]);
    }
}