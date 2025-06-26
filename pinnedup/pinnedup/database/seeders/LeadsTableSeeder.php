<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lead;

class LeadsTableSeeder extends Seeder
{
    public function run()
    {
        Lead::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '555-1234',
            'address' => '123 Main Street',
            'status' => 'new',
            'company_name' => 'John Consulting',
            'source' => 'website',
            'tags' => '["VIP"]',
        ]);

        Lead::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '555-5678',
            'address' => '456 Park Avenue',
            'status' => 'contacted',
            'company_name' => 'Smith Solutions',
            'source' => 'referral',
            'tags' => '["Potential"]',
        ]);
    }
}
