<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user
        User::create([
            'name' => 'Test User',
            'email' => 'test@travelexpress.com',
            'password' => Hash::make('password123'),
        ]);

        // Create an admin user
        User::create([
            'name' => 'Admin Travel Express',
            'email' => 'admin@travelexpress.com',
            'password' => Hash::make('admin123'),
        ]);

        echo "✓ 2 utilisateurs de test créés avec succès!\n";
        echo "  - test@travelexpress.com (password: password123)\n";
        echo "  - admin@travelexpress.com (password: admin123)\n";
    }
}
