<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Form;
use Filament\Forms;

class ViewProject extends ViewRecord
{
    protected static string $resource = ProjectResource::class;

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('id')->disabled()->label('Project ID'),
            Forms\Components\TextInput::make('name')->disabled()->label('Project Name'),
            Forms\Components\Textarea::make('description')->disabled(),
            Forms\Components\TextInput::make('client.name')->disabled()->label('Client'),
            Forms\Components\DatePicker::make('start_date')->disabled(),
            Forms\Components\DatePicker::make('deadline')->disabled(),
            Forms\Components\TextInput::make('status')->disabled(),
            Forms\Components\TextInput::make('priority')->disabled(),
            Forms\Components\TextInput::make('tags')->disabled()->label('Tags'),
        ]);
    }
}
