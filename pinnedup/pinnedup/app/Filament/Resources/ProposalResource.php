<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProposalResource\Pages;
use App\Models\Proposal;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProposalResource extends Resource
{
    protected static ?string $model = Proposal::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Project Management';
    protected static ?int $navigationSort = 2;

    // -- FORM --
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Title
                Forms\Components\TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),

                // Status
                Forms\Components\Select::make('status')
                    ->label('Proposal Status')
                    ->options([
                        'pending'  => 'Pending',
                        'accepted' => 'Accepted',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),

                // Features (Repeater)
                Forms\Components\Repeater::make('features')
                    ->label('Features')
                    ->schema([
                        Forms\Components\TextInput::make('feature')
                            ->label('Feature')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->createItemButtonLabel('Add Feature')
                    ->minItems(1),

                // Description
                Forms\Components\Textarea::make('description')
                    ->label('Proposal Description')
                    ->maxLength(500),

                // Associated Lead
                Forms\Components\Select::make('lead_id')
                    ->label('Associated Lead/Client')
                    ->relationship('lead', 'name')
                    ->searchable()
                    ->required(),

                // Budget
                Forms\Components\TextInput::make('budget')
                    ->label('Budget')
                    ->numeric(),

                // Discount
                Forms\Components\TextInput::make('discount')
                    ->label('Discount (%)')
                    ->numeric(),

                // Price
                Forms\Components\TextInput::make('price')
                    ->label('Price')
                    ->numeric()
                    ->required(),

                // Total Price
                Forms\Components\TextInput::make('total_price')
                    ->label('Total Price')
                    ->numeric()
                    ->disabled()
                    ->default(fn ($get) => $get('price')
                        ? ($get('price') - (($get('price') * $get('discount')) / 100))
                        : null
                    ),

                // Start Date
                Forms\Components\DatePicker::make('start_date')
                    ->label('Start Date'),

                // Deadline
                Forms\Components\DatePicker::make('deadline')
                    ->label('Deadline'),

                // read-only created_at + updated_at (optional)
                Forms\Components\DatePicker::make('created_at')
                    ->label('Proposal Creation Date')
                    ->default(now())
                    ->disabled(),

                Forms\Components\DatePicker::make('updated_at')
                    ->label('Last Edited Date')
                    ->default(now())
                    ->disabled(),
            ]);
    }

    // -- TABLE --
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('lead.name')
                    ->label('Associated Lead')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->money('usd')
                    ->sortable(),
            ])
            ->filters([
                // Example filter if needed
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),  // if you'd like a built-in "view" page
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('title', 'asc')
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    // -- RELATIONS (optional) --
    public static function getRelations(): array
    {
        return [
            // ...
        ];
    }

    // -- PAGES --
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProposals::route('/'),
            'create' => Pages\CreateProposal::route('/create'),
            'edit' => Pages\EditProposal::route('/{record}/edit'),
            // If you want to enable the built-in "ViewAction",
            // you need a "ViewProposal" page. You can create that with:
            // php artisan make:filament-resource Proposal --view
            //
             'view' => Pages\ViewProposal::route('/{record}'),
        ];
    }
}
