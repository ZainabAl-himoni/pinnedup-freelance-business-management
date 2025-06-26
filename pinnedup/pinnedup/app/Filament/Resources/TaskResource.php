<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



class TaskResource extends Resource
{
    protected static ?string $navigationIcon = 'heroicon-o-check-circle';

    protected static ?string $navigationGroup = 'Project Management';
    protected static ?int $navigationSort = 3;

 public static function form(Form $form): Form
    {
    return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Task Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\DatePicker::make('start_date')
                    ->label('Start Date')
                    ->required(),

                Forms\Components\DatePicker::make('deadline')
                    ->label('Deadline')
                    ->required(),

                Forms\Components\Select::make('project_id')
                    ->label('Associated Project')
                    ->relationship('project', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Task Description')
                    ->maxLength(500),

                Forms\Components\Select::make('status')
                    ->label('Task Status')
                    ->options([
                        'Pending' => 'Pending',
                        'In Progress' => 'In Progress',
                        'Completed' => 'Completed',
                        'On Hold' => 'On Hold',
                    ])
                    ->default('Pending')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Task Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('project.name')
                    ->label('Associated Project')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date('d/m/Y'),

                Tables\Columns\TextColumn::make('deadline')
                    ->label('Deadline')
                    ->date('d/m/Y'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'primary' => 'Pending',
                        'warning' => 'In Progress',
                        'success' => 'Completed',
                        'secondary' => 'On Hold',
                    ]),
            ])
            ->filters([
                // Add any required filters here
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ]) ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('start_date', 'desc')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // Define any relations if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }


}
