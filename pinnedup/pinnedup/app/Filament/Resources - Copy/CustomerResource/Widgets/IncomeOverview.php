<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use App\Models\Client;
use App\Models\Invoice;
use App\Models\Lead;
use App\Models\Project;
use App\Models\Proposals;
use App\Models\Task;
use Filament\Widgets\LineChartWidget;

class IncomeOverview extends LineChartWidget
{
    protected static ?string $heading = 'Income Overview';

    protected function getData(): array
    {
        // Fetch paid invoices grouped by month
        $invoices = Invoice::where('status', 'Paid')
            ->selectRaw('SUM(amount) as total, MONTH(created_at) as month')
            ->groupBy('month')
            ->pluck('total', 'month');

        // Additional statistics
        $stats = [
            'clients' => Client::count(),
            'leads' => Lead::count(),
            'projects' => Project::count(),
            'proposals' => Proposals::count(),
            'tasks' => Task::count(),
        ];

        return [
            'datasets' => [
                [
                    'label' => 'Income',
                    'data' => array_values($invoices->toArray()),
                    'backgroundColor' => '#4caf50',
                    'borderColor' => '#4caf50',
                    'fill' => false,
                ],
            ],
            'labels' => [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December',
            ],
            'extra' => $stats, // Add the statistics to the response
        ];
    }
}
