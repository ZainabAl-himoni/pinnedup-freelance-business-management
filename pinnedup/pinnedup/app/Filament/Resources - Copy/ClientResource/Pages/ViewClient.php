<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Actions;

class ViewClient extends ViewRecord
{
    protected static string $resource = ClientResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    /**
     * Override the form() to display read-only fields.
     */
    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Basic Info')->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Client Name')
                    ->disabled(),
                Forms\Components\TextInput::make('email')
                    ->disabled(),
                Forms\Components\TextInput::make('phone')
                    ->disabled(),
                Forms\Components\TextInput::make('company_name')
                    ->disabled(),
            ]),
            Forms\Components\Section::make('Lead & Status')->schema([
                Forms\Components\TextInput::make('lead_id')
                    ->disabled(),
                Forms\Components\TextInput::make('status')
                    ->disabled(),
                Forms\Components\TextInput::make('source')
                    ->disabled(),
            ]),
            Forms\Components\Section::make('Other')->schema([
                Forms\Components\TextInput::make('tags')
                    ->disabled(),
                Forms\Components\Textarea::make('address')
                    ->disabled(),
            ]),
        ]);
    }
}
