<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Form;
use Filament\Forms;

class ViewTask extends ViewRecord
{
    protected static string $resource = TaskResource::class;

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('id')->disabled()->label('Task ID'),
            Forms\Components\TextInput::make('name')->disabled()->label('Task Name'),
            Forms\Components\Textarea::make('description')->disabled()->label('Description'),
            Forms\Components\TextInput::make('project.name')->disabled()->label('Project'),
            Forms\Components\DatePicker::make('start_date')->disabled()->label('Start Date'),
            Forms\Components\DatePicker::make('deadline')->disabled()->label('Deadline'),
            Forms\Components\TextInput::make('status')->disabled()->label('Status'),
        ]);
    }
}
