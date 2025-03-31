<?php
namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class GenerateAdminUser extends Command
{
    protected $signature = 'admin:create {email} {password}';
    protected $description = 'Tạo tài khoản admin mới';

    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = User::create([
            'name' => 'Administrator',
            'email' => $email,
            'password' => Hash::make($password),
            'role' => 'admin'
        ]);

        $this->info('Tạo tài khoản admin thành công!');
    }
}