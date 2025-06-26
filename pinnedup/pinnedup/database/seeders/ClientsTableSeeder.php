<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        // Client referencing the first lead (ID=1)
        Client::create([
            'name' => 'Acme Corp',
            'email' => 'info@acme.com',
            'phone' => '555-9999',
            'address' => '789 Industrial Road',
            'lead_id' => 1, // from John Doe lead
            'status' => 'converted',
            'company_name' => 'Acme Corp',
            'source' => 'website',
            'tags' => 'Top Tier',
        ]);

        // Client referencing the second lead (ID=2)
        Client::create([
            'name' => 'Beta LLC',
            'email' => 'contact@beta.com',
            'phone' => '555-8888',
            'address' => '321 Corporate Blvd',
            'lead_id' => 2, // from Jane Smith lead
            'status' => 'converted',
            'company_name' => 'Beta LLC',
            'source' => 'referral',
            'tags' => '["Repeat"]',
        ]);
    }
}
