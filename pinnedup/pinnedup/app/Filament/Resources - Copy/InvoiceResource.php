<?php

namespace App\Filament\Resources;

 use App\Filament\Resources\InvoiceResource\Pages\CreateInvoice;
 use App\Filament\Resources\InvoiceResource\Pages\EditInvoice;
 use App\Filament\Resources\InvoiceResource\Pages\ListInvoices;
 use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;
    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationLabel = 'Invoices';
    protected static ?string $navigationGroup = 'Financial';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Invoice Details')->schema([
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
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'warning' => 'Pending',
                        'success' => 'Paid',
                        'danger' => 'Overdue',
                        'secondary' => 'Canceled',
                    ])
                    ->sortable(),
                Tables\Columns\TextColumn::make('task.name')
                    ->label('Task Name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Date')
                    ->date('d/m/Y')
                    ->sortable(),
            ])
            ->filters([
                Filter::make('Paid')->query(fn (Builder $q) => $q->where('status', 'Paid')),
                Filter::make('Overdue')->query(fn (Builder $q) => $q->where('status', 'Overdue')),
                Filter::make('date_range')
                    ->form([
                        Forms\Components\DatePicker::make('from'),
                        Forms\Components\DatePicker::make('until'),
                    ])
                    ->query(function (Builder $q, array $data) {
                        return $q
                            ->when($data['from'], fn ($query, $date) => $query->whereDate('date', '>=', $date))
                            ->when($data['until'], fn ($query, $date) => $query->whereDate('date', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('date', 'desc')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInvoices::route('/'),
            'create' => CreateInvoice::route('/create'),
            'view' => ViewInvoice::route('/{record}'),
            'edit' => EditInvoice::route('/{record}/edit'),
        ];
    }
}
