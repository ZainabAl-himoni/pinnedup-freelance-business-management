<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProposalsResource\pages\CreateProposals;
use App\Filament\Resources\ProposalsResource\Pages\EditProposals;
use App\Filament\Resources\ProposalsResource\Pages\ListProposals;
use App\Filament\Resources\ProposalsResource\Pages\ViewProposals;
use App\Filament\Resources\ProposalsResource\ViewProposal;
use App\Models\Proposals;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
 use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProposalsResource extends Resource
{
    protected static ?string $model = Proposals::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Proposals';
    protected static ?string $navigationGroup = 'CRM';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('budget')
                ->label('Budget')
                ->numeric()
                ->required(),
            Forms\Components\DatePicker::make('start_date')
                ->label('Start Date')
                ->required(),
            Forms\Components\DatePicker::make('deadline')
                ->label('Deadline')
                ->required(),
            Forms\Components\Select::make('lead_id')
                ->label('Associated Lead')
                ->relationship('lead', 'name')
                ->searchable()
                ->required(),
            Forms\Components\Textarea::make('description')
                ->label('Proposal Description')
                ->maxLength(500),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('budget')
                    ->label('Budget')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('lead.name')
                    ->label('Lead')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')
                    ->date('d/m/Y'),
                Tables\Columns\TextColumn::make('deadline')
                    ->label('Deadline')
                    ->date('d/m/Y'),
                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50),
            ])
            ->filters([])
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
            'index' => ListProposals::route('/'),
            'create' => CreateProposals::route('/create'),
            'view' => ViewProposals::route('/{record}'),
            'edit' => EditProposals::route('/{record}/edit'),
        ];
    }
}
