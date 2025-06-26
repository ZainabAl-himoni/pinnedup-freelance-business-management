<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use App\Models\Task;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class UpcomingTasks extends BaseWidget
{
    protected static ?string $heading = 'Upcoming Tasks';

    protected function getTableQuery(): Builder
    {
        return Task::query()
            ->whereDate('start_date', '>=', now()) // Only tasks starting today or later
            ->orderBy('start_date', 'asc'); // Order by start date
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label('Task Name')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('project.name')
                ->label('Project')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('start_date')
                ->label('Start Date')
                ->sortable()
                ->date('d/m/Y'),

            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'primary' => 'Pending',
                    'success' => 'Completed',
                    'warning' => 'In Progress',
                    'danger' => 'Overdue',
                ])
                ->sortable(),

            Tables\Columns\TextColumn::make('deadline')
                ->label('Deadline')
                ->sortable()
                ->date('d/m/Y'),
        ];
    }

    protected function getTableFilters(): array
    {
        return [
            Tables\Filters\SelectFilter::make('status')
                ->label('Status')
                ->options([
                    'Pending' => 'Pending',
                    'In Progress' => 'In Progress',
                    'Completed' => 'Completed',
                    'Overdue' => 'Overdue',
                ]),
        ];
    }
}
