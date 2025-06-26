<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'CRM';
    protected static ?int $navigationSort = 2;

    // -- FORM --
    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('amount')
                ->label('Invoice Amount')
                ->numeric()
                ->required(),

            Forms\Components\Select::make('status')
                ->label('Invoice Status')
                ->options([
                    'Pending' => 'Pending',
                    'Paid' => 'Paid',
                    'Overdue' => 'Overdue',
                    'Canceled' => 'Canceled',
                ])
                ->default('Pending')
                ->required(),

            Forms\Components\Select::make('task_id')
                ->label('Associated Task')
                ->relationship('task', 'name')
                ->searchable()
                ->required(),

            Forms\Components\DatePicker::make('date')
                ->label('Invoice Date')
                ->required(),
        ]);
    }

    // -- TABLE --
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->sortable(),

                Tables\Columns\TextColumn::make('task.name')
                    ->label('Task Name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('d/m/Y'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // Add a "View" action that goes to the new ViewInvoice page
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('date', 'desc');
    }

    // -- PAGES --
    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit'   => Pages\EditInvoice::route('/{record}/edit'),
            // Enable a dedicated "View" page for custom PDF/Email actions
            'view'   => Pages\ViewInvoice::route('/{record}'),
        ];
    }
}
