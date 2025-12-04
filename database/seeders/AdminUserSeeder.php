<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin user already exists
        $adminExists = User::where('email', 'admin@travelexpress.com')->exists();

        if (!$adminExists) {
            User::create([
                'name' => 'Administrateur',
                'email' => 'admin@travelexpress.com',
                'password' => Hash::make('Admin@2025'),
                'country' => 'France',
                'position' => 'Administrateur',
                'bio' => 'Compte administrateur principal',
                'language' => 'fr',
                'is_admin' => true,
                'email_verified_at' => now(),
            ]);

            $this->command->info('Utilisateur administrateur créé avec succès!');
            $this->command->info('Email: admin@travelexpress.com');
            $this->command->info('Mot de passe: Admin@2025');
        } else {
            $this->command->warn('L\'utilisateur administrateur existe déjà.');
        }
    }
}
