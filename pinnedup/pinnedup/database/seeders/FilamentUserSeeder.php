<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;          // <-- Ensure this is your user model
use Illuminate\Support\Facades\Hash;

class FilamentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default admin user
        User::updateOrCreate(
            [ 'email' => 'admin@admin.com' ],    // Check if this email already exists
            [
                'name' => 'Filament Admin',
                'password' => Hash::make('password'),  // Change to a secure password
            ]
        );
    }
}
