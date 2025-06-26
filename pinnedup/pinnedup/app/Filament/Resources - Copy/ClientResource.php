<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';
    protected static ?string $navigationLabel = 'Clients';
    protected static ?string $navigationGroup = 'CRM'; // Optional grouping in Filament sidebar

    // Optional: If you want to rename the Model label
    protected static ?string $modelLabel = 'Client';
    protected static ?string $pluralModelLabel = 'Clients';

    // Example: This controls the order in the Filament sidebar
    protected static ?int $navigationSort = 2;

    // Example: If you want a different route name:
    // protected static ?string $slug = 'customers';

    /**
     * Define the table (list view).
     */
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Display columns
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone'),
                Tables\Columns\TextColumn::make('company_name')
                    ->label('Company'),
                Tables\Columns\TextColumn::make('lead_id')
                    ->label('Lead')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // optional toggle
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Example: Filter by "converted" status
                Filter::make('Converted')
                    ->query(fn (Builder $query) => $query->where('status', 'converted')),
                // Example: Filter by "closed" status
                Filter::make('Closed')
                    ->query(fn (Builder $query) => $query->where('status', 'closed')),
                // You can add more advanced filters, date range filters, etc.
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),   // "View" page
                Tables\Actions\EditAction::make(),   // "Edit" page
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    /**
     * Define the default Eloquent query used for the resource.
     * Example: If you only want to show clients with a lead_id, uncomment the code below.
     */
    /*
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereNotNull('lead_id');
    }
    */

    /**
     * Optionally disable creation from the table + global button.
     * Just return false if you never want to create from Filament.
     */
    public static function canCreate(): bool
    {
        return true; // or false if you want to prevent creation
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'view' => Pages\ViewClient::route('/{record}'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
