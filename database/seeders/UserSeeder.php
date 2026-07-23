<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seedتer;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Jawad Owner',
                'email' => 'Jawad@tripshub.com',
                'password' => Hash::make('OJawad123'),
                'role' => 'owner',
            ],
            [
                'name' => 'Sedra Owner',
                'email' => 'Sedra@tripshub.com',
                'password' => Hash::make('OSedra123'),
                'role' => 'owner',
            ],
            [
                'name' => 'Admin Office Manager',
                'email' => 'admin@tripshub.com',
                'password' => Hash::make('Admin123'),
                'role' => 'admin',
                'num1' => '0978123456',
                'num2' => '0987234567',
            ],
            [
                'name' => 'Al-Atlat Al shamia',
                'email' => 'damascus@office.com',
                'password' => Hash::make('password123'),
                'role' => 'office',
                'num1' => '0912345678',
                'num2' => '0976543210',
            ],
            [
                'name' => 'Aleppo Tours',
                'email' => 'aleppo@office.com',
                'password' => Hash::make('password123'),
                'role' => 'office',
                'num1' => '0923456789',
                'num2' => '0987654321',
            ],
            [
                'name' => 'Al-Rasafa for Tourism and Travel',
                'email' => 'homs@office.com',
                'password' => Hash::make('password123'),
                'role' => 'office',
                'num1' => '0934567890',
                'num2' => '0978912345',
            ],
            [
                'name' => 'ALi Ali',
                'email' => 'Ali@user.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'num1' => '0946352718',
                'num2' => '0971826354',
            ],
            [
                'name' => 'Ahmad Aisa',
                'email' => 'Ahmad@user.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'num1' => '0957283645',
                'num2' => '0976453829',
            ],
            [
                'name' => 'Noor sawan',
                'email' => 'Noor@user.com',
                'password' => Hash::make('password123'),
                'role' => 'user',
                'num1' => '0963748291',
                'num2' => '0978192746',
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
