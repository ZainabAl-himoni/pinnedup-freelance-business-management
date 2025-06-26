<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Invoice;

class InvoicesTableSeeder extends Seeder
{
    public function run()
    {
        // Invoice for Task ID=1 (Design Wireframes)
        Invoice::create([
            'amount' => 2000.00,
            'status' => 'Pending',
            'task_id' => 1,
            'date' => '2025-01-31',
        ]);

        // Invoice for Task ID=2 (Client Feedback)
        Invoice::create([
            'amount' => 500.00,
            'status' => 'Paid',
            'task_id' => 2,
            'date' => '2025-02-15',
        ]);
    }
}
