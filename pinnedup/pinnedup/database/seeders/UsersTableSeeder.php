<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First user with specific custom_fields
        User::create([
            'name' => 'Main User',
            'email' => 'mainuser@example.com',
            'password' => Hash::make('password'),
            'behance' => 'http://127.0.0.1:8000/admin/my-profile',
            'dribbble' => 'http://127.0.0.1:8000/admin/my-profile',
            'linkedin' => 'http://127.0.0.1:8000/admin/my-profile',
            'github' => 'http://127.0.0.1:8000/admin/my-profile',
            'signature' => 'Main User Signature',
            'profile_image' => 'profile_image_1.jpg',
            'custom_fields' => json_encode([
                'behance' => 'http://127.0.0.1:8000/admin/my-profile',
                'dribbble' => 'http://127.0.0.1:8000/admin/my-profile',
                'linkedin' => 'http://127.0.0.1:8000/admin/my-profile',
                'github' => 'http://127.0.0.1:8000/admin/my-profile',
            ]),
        ]);

        // Two additional random users
        User::factory()->count(2)->create();
    }
}
