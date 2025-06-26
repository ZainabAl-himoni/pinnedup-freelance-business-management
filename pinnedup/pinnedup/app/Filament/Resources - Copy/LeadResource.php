<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
 use Filament\Tables;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Leads';
    protected static ?string $navigationGroup = 'CRM'; // or any group you like

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->required()
                            ->label('Lead Name'),
                        TextInput::make('email')
                            ->email()
                            ->label('Email'),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('phone')
                            ->label('Phone'),
                        TextInput::make('company_name')
                            ->label('Company'),
                    ]),
                    Textarea::make('address')
                        ->label('Address')
                        ->rows(2),
                    Select::make('status')
                        ->options([
                            'new'       => 'New',
                            'contacted' => 'Contacted',
                            'converted' => 'Converted',
                            'closed'    => 'Closed',
                        ])
                        ->default('new')
                        ->label('Status'),
                    Select::make('source')
                        ->options([
                            'website'       => 'Website',
                            'referral'      => 'Referral',
                            'advertisement' => 'Advertisement',
                            'event'         => 'Event',
                            'other'         => 'Other',
                        ])
                        ->default('website')
                        ->label('Source'),

                    // If you want to manage tags as an array:
                    Repeater::make('tags')
                        ->label('Tags')
                        ->schema([
                            TextInput::make('value')
                                ->label('Tag')
                                ->required(),
                        ])
                        ->columns(1)
                        ->createItemButtonLabel('Add Tag')
                        ->default([]),

                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('status')
                    ->sortable()
                    ->colors([
                        'primary' => 'new',
                        'warning' => 'contacted',
                        'success' => 'converted',
                        'danger'  => 'closed',
                    ]),
                TextColumn::make('source')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('tags')
                    ->formatStateUsing(function ($state) {
                        // If the state is an array of objects with "value", we can:
                        if (is_array($state)) {
                            return collect($state)->pluck('value')->join(', ');
                        }
                        return $state;
                    })
                    ->label('Tags'),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                // Filament table filters, if needed
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    /**
     * If you have relation managers, define them here:
     */
    public static function getRelations(): array
    {
        return [
            // e.g. ClientsRelationManager::class,
            // e.g. ProposalsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit'   => Pages\EditLead::route('/{record}/edit'),
            'view'   => Pages\ViewLead::route('/{record}'),
        ];
    }
}
