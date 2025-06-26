<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use App\Models\Project;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class ProjectTaskOverview extends BaseWidget
{
    protected static ?string $heading = 'Project and Task Overview';

    /**
     * Get the query for the table.
     *
     * @return Builder|Illuminate\Database\Eloquent\Relations\Relation|null
     */
    protected function getTableQuery(): Builder
    {
        // Return a query builder with the relationship included
        return Project::query()->with('tasks');
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label('Project Name')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('client.name')
                ->label('Client')
                ->searchable()
                ->sortable(),

            Tables\Columns\TextColumn::make('tasks_count')
                ->label('Total Tasks')
                ->counts('tasks'),

            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'primary' => 'Pending',
                    'success' => 'Completed',
                    'warning' => 'In Progress',
                    'danger' => 'Canceled',
                    'secondary' => 'On Hold',
                ]),

        ];
    }
}
