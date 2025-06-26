<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use App\Models\Task;
use Filament\Widgets\DoughnutChartWidget;

class TaskStatus extends DoughnutChartWidget
{
    protected static ?string $heading = 'Task Status Distribution';

    protected function getData(): array
    {
        // Fetch tasks grouped by status
        $taskCounts = Task::select('status', \DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        return [
            'labels' => $taskCounts->keys()->toArray(), // Task statuses
            'datasets' => [
                [
                    'label' => 'Tasks by Status',
                    'data' => $taskCounts->values()->toArray(),
                    'backgroundColor' => [
                        '#d12313', // Pending
                        '#0ac72b', // Completed
                        '#1084c7', // In Progress
                        '#FFC300', // On Hold
                        '#FF33A1', // Canceled
                    ],
                    'options' => [
                        'plugins' => [
                            'tooltip' => [
                                'callbacks' => [
                                    'label' => function () {
                                        return '
                                            function(context) {
                                                let value = context.raw;
                                                return context.label + ": " + Math.round(value) + " tasks";
                                            }
                                        ';
                                    },
                                ],
                            ],
                        ],


                    ],


                ],

            ],
            'scales' => [
                'y' => false, // Remove Y-axis
            ],
        ];
    }
}
