<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;

class TasksTableSeeder extends Seeder
{
    public function run()
    {
        // Task referencing Project ID=1
        Task::create([
            'name' => 'Design Wireframes',
            'description' => 'Create initial wireframes for Acme website overhaul.',
            'project_id' => 1,
            'start_date' => '2025-01-15',
            'deadline' => '2025-01-31',
            'status' => 'In Progress',
        ]);

        // Another Task referencing Project ID=1
        Task::create([
            'name' => 'Client Feedback',
            'description' => 'Review wireframes with Acme Corp stakeholders.',
            'project_id' => 1,
            'start_date' => '2025-02-01',
            'deadline' => '2025-02-05',
            'status' => 'Pending',
        ]);

        // Task referencing Project ID=2
        Task::create([
            'name' => 'Market Analysis',
            'description' => 'Research target demographics for Beta marketing campaign.',
            'project_id' => 2,
            'start_date' => '2025-02-05',
            'deadline' => '2025-02-20',
            'status' => 'Pending',
        ]);
    }
}
