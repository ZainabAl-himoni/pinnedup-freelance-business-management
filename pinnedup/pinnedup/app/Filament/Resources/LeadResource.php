<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LeadResource\Pages;
 use App\Models\Lead;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'CRM';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('name')
            ->label('Name')
            ->required()
            ->maxLength(255),

        Forms\Components\TextInput::make('email')
            ->label('Email')
            ->email()
            ->required()
            ->maxLength(255),

        Forms\Components\TextInput::make('phone')
            ->label('Phone')
            ->nullable()
            ->numeric()
            ->type('tel')
            ->maxLength(20),

        Forms\Components\Select::make('status')
            ->label('Status')
            ->options([
                'new' => 'New',
                'contacted' => 'Contacted',
                'converted' => 'Converted',
                'closed' => 'Closed',
            ])
            ->default('new')
            ->required(),

        Forms\Components\TextInput::make('company_name')
            ->label('Company Name')
            ->nullable()
            ->maxLength(255),

        Forms\Components\Select::make('source')
            ->label('Source')
            ->options([
                'website' => 'Website',
                'referral' => 'Referral',
                'advertisement' => 'Advertisement',
                'event' => 'Event',
                'other' => 'Other',
            ])
            ->default('website')
            ->required(),

        Forms\Components\TagsInput::make('tags')
            ->label('Tags')
            ->placeholder('Add tags for categorization'),
    ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
            Tables\Columns\TextColumn::make('name')->label('Name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('status')->label('Status')->sortable(),
            Tables\Columns\TextColumn::make('company_name')->label('Company Name')->sortable()->searchable(),
            Tables\Columns\TextColumn::make('source')->label('Source')->sortable(),
            Tables\Columns\TagsColumn::make('tags')->label('Tags'),
            Tables\Columns\TextColumn::make('created_at')->label('Created At')->date()->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                ->options([
                    'new' => 'New',
                    'contacted' => 'Contacted',
                    'converted' => 'Converted',
                    'closed' => 'Closed',
                ])
                ->label('Status'),

                Tables\Filters\SelectFilter::make('source')
                ->options([
                    'website' => 'Website',
                    'referral' => 'Referral',
                    'advertisement' => 'Advertisement',
                    'event' => 'Event',
                    'other' => 'Other',
                ])
                ->label('Source'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLeads::route('/'),
            'create' => Pages\CreateLead::route('/create'),
            'edit' => Pages\EditLead::route('/{record}/edit'),
        ];
    }
}
