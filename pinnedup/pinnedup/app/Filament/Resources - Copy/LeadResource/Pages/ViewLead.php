<?php

namespace App\Filament\Resources\LeadResource\Pages;

use App\Filament\Resources\LeadResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Form;
use Filament\Forms;

class ViewLead extends ViewRecord
{
    protected static string $resource = LeadResource::class;

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('id')->disabled()->label('Lead #'),
            Forms\Components\TextInput::make('name')->disabled(),
            Forms\Components\TextInput::make('email')->disabled(),
            Forms\Components\TextInput::make('phone')->disabled(),
            Forms\Components\TextInput::make('company_name')->label('Company')->disabled(),
            Forms\Components\TextInput::make('address')->disabled(),
            Forms\Components\TextInput::make('status')->disabled(),
            Forms\Components\TextInput::make('source')->disabled(),
            Forms\Components\TextInput::make('tags')->disabled(),
        ]);
    }
}
