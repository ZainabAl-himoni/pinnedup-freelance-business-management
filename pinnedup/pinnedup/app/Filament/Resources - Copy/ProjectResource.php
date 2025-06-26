<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TagsColumn;
use Illuminate\Database\Eloquent\Builder;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Projects';
    protected static ?string $navigationGroup = 'CRM';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Project Name')
                ->required()
                ->maxLength(255),
            Forms\Components\Textarea::make('description')
                ->label('Project Description')
                ->maxLength(500),
            Forms\Components\Select::make('client_id')
                ->label('Associated Client')
                ->relationship('client', 'name')
                ->searchable()
                ->required(),
            Forms\Components\DatePicker::make('start_date')
                ->label('Start Date')
                ->required(),
            Forms\Components\DatePicker::make('deadline')
                ->label('Deadline')
                ->required(),
            Forms\Components\Select::make('status')
                ->label('Project Status')
                ->options([
                    'Pending' => 'Pending',
                    'In Progress' => 'In Progress',
                    'Completed' => 'Completed',
                    'On Hold' => 'On Hold',
                    'Canceled' => 'Canceled',
                ])
                ->default('Pending'),
            Forms\Components\Select::make('priority')
                ->label('Priority Level')
                ->options([
                    'Low' => 'Low',
                    'Medium' => 'Medium',
                    'High' => 'High',
                ])
                ->default('Medium'),
            TagsInput::make('tags')
                ->label('Tags')
                ->placeholder('Enter tags...')
                ->helperText('Stores tags as an array'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Project Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('client.name')
                    ->label('Client Name')
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
                        'success' => 'Completed',
                        'warning' => 'In Progress',
                        'danger' => 'Canceled',
                        'secondary' => 'On Hold',
                    ]),
                Tables\Columns\BadgeColumn::make('priority')
                    ->label('Priority')
                    ->colors([
                        'success' => 'Low',
                        'warning' => 'Medium',
                        'danger' => 'High',
                    ]),
                TagsColumn::make('tags')
                    ->label('Tags'),
            ])
            ->filters([
                // For example, filter by status or priority if desired
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('start_date', 'desc')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
