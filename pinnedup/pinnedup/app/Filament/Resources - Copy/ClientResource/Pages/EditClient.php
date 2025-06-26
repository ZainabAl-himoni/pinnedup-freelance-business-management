<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Actions;

class EditClient extends EditRecord
{
    public static string $resource = ClientResource::class;

    protected function getActions(): array
    {
        return [
            // e.g. a Delete action or a custom action
            Actions\DeleteAction::make(),
            Actions\ViewAction::make(), // Let us jump to the view page from here
        ];
    }

    /**
     * Customize the Edit form layout.
     */
    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('Client Details')->tabs([
                Forms\Components\Tabs\Tab::make('General Info')->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Client Name')
                        ->required(),
                    Forms\Components\TextInput::make('email')
                        ->email()
                        ->label('Email'),
                    Forms\Components\TextInput::make('phone')
                        ->label('Phone'),
                    Forms\Components\TextInput::make('company_name')
                        ->label('Company Name'),
                ]),
                Forms\Components\Tabs\Tab::make('Lead & Status')->schema([
                    Forms\Components\Select::make('lead_id')
                        ->label('Lead')
                        ->relationship('lead', 'name')
                        ->searchable()
                        ->placeholder('Select Lead')
                        ->helperText('Assign this client to an existing lead.'),
                    Forms\Components\Select::make('status')
                        ->options([
                            'new' => 'New',
                            'contacted' => 'Contacted',
                            'converted' => 'Converted',
                            'closed' => 'Closed',
                        ])
                        ->default('converted')
                        ->label('Status'),
                    Forms\Components\TextInput::make('source')
                        ->label('Source')
                        ->helperText('e.g., website, referral, advertisement...'),
                ]),
                Forms\Components\Tabs\Tab::make('Address & Tags')->schema([
                    Forms\Components\Textarea::make('address')
                        ->label('Address'),
                    Forms\Components\TextInput::make('tags')
                        ->label('Tags')
                        ->helperText('Comma-separated or JSON array'),
                ]),
            ]),
        ]);
    }
}
