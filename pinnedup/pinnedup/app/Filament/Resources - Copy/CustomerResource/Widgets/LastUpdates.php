<?php

namespace App\Filament\Resources\CustomerResource\Widgets;

use App\Models\Update;
use Filament\Tables;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LastUpdates extends TableWidget
{
    protected static ?string $heading = 'Last Updates';

    /**
     * Define the query for the table widget.
     *
     * @return Builder
     */
    protected function getTableQuery(): Builder
    {
        return Update::query()
            ->orderByDesc('updated_at');
    }

    /**
     * Define the columns for the table widget.
     *
     * @return array
     */
    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label('Name/Title')
                ->searchable()
                ->sortable()
                ->limit(50),

            Tables\Columns\TextColumn::make('status')
                ->label('Status')
                ->sortable()
                ->searchable()
                ->toggleable()
                ->formatStateUsing(function ($state) {
                    return $state ?: 'N/A';
                }),

            Tables\Columns\TextColumn::make('type')
                ->label('Type')
                ->sortable(),

            Tables\Columns\TextColumn::make('updated_at')
                ->label('Last Updated')
                ->sortable()
                ->dateTime('d/m/Y H:i'),
        ];
    }

    /**
     * Optionally, you can define additional table configurations here.
     *
     * @return array
     */
    protected function getTableFilters(): array
    {
        return [
            // Example filter: Filter by type
            Tables\Filters\SelectFilter::make('type')
                ->options([
                    'Lead' => 'Lead',
                    'Proposal' => 'Proposal',
                    'Client' => 'Client',
                    'Task' => 'Task',
                    'Project' => 'Project',
                    'Invoice' => 'Invoice',
                ]),
        ];
    }

    /**
     * Optionally, you can define table actions here.
     *
     * @return array
     */
    protected function getTableActions(): array
    {
        return [
            // Example action: View details
            Tables\Actions\Action::make('view')
                ->label('View')
                ->url(function ($record) {
                    // Define URLs based on the type
                    switch ($record->type) {
                        case 'Lead':
                            return 2;
                        case 'Proposal':
                            return 3;
                        case 'Client':
                            return 4;
                        case 'Task':
                            return 1;
                        case 'Project':
                            return 5;
                        case 'Invoice':
                            return 6;
                        default:
                            return '#';
                    }
                })
                ->openUrlInNewTab(),
        ];
    }
}
