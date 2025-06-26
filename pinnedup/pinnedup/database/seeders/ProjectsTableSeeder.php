<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectsTableSeeder extends Seeder
{
    public function run()
    {
        // Project for Client with ID=1
        Project::create([
            'name' => 'Acme Website Overhaul',
            'description' => 'Redesign the company website for Acme Corp',
            'client_id' => 1, // references Acme Corp
            'start_date' => '2025-01-10',
            'deadline' => '2025-03-01',
            'status' => 'In Progress',
            'priority' => 'High',
            'tags' => json_encode(['WebDev', 'Redesign']),
        ]);

        // Project for Client with ID=2
        Project::create([
            'name' => 'Beta Marketing Campaign',
            'description' => 'Launch a new marketing campaign for Beta LLC',
            'client_id' => 2,
            'start_date' => '2025-02-01',
            'deadline' => '2025-05-01',
            'status' => 'Pending',
            'priority' => 'Medium',
            'tags' => json_encode(['Marketing', 'SocialMedia']),
        ]);
    }
}
