<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@pohonkeluarga.com',
            'phone' => '081234567890',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_approved' => true,
            'email_verified_at' => now(),
        ]);

        // Create some test users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '081234567891',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_approved' => true,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '081234567892',
            'password' => Hash::make('password'),
            'role' => 'user',
            'is_approved' => false,
            'email_verified_at' => null,
        ]);

        User::create([
            'name' => 'Ilham Gading',
            'email' => 'gadinglalala121212@gmail.com',
            'phone' => '083845586939',
            'password' => Hash::make('123'),
            'role' => 'user',
            'is_approved' => true,
            'email_verified_at' => now(),
        ]);
    }
}
