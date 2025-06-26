<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use App\Models\Lead;
use Filament\Widgets\LineChartWidget;

class LeadsAndClients extends LineChartWidget
{
    protected static ?string $heading = 'Leads and Clients Growth';

    protected function getData(): array
    {
        // Fetch leads grouped by month
        $leads = Lead::selectRaw('COUNT(*) as count, MONTH(created_at) as month')
            ->groupBy('month')
            ->pluck('count', 'month');

        // Fetch clients grouped by month
        $clients = Lead::where('status', 'converted')
            ->selectRaw('COUNT(*) as count, MONTH(updated_at) as month')
            ->groupBy('month')
            ->pluck('count', 'month');

        return [
            'datasets' => [
                [
                    'label' => 'Leads',
                    'data' => $leads->toArray(),
                    'backgroundColor' => '#4caf50',
                    'borderColor' => '#4caf50',
                    'fill' => false,
                ],
                [
                    'label' => 'Clients',
                    'data' => $clients->toArray(),
                    'backgroundColor' => '#2196f3',
                    'borderColor' => '#2196f3',
                    'fill' => false,
                ],
            ],
            'labels' => [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December',
            ],
            'options' => [
                'scales' => [
                    'y' => [
                        'beginAtZero' => true,
                        'ticks' => [
                            'stepSize' => 10, // Set the interval for Y-axis
                            'precision' => 0, // Ensure no decimal values
                        ],
                    ],
                ],
            ],
        ];
    }
}
