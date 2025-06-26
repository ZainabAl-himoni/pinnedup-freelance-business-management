<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;
    protected function getActions(): array
    {
        return [
            // e.g. Actions\LocaleSwitcher::make(), if multi-lingual
        ];
    }
}
