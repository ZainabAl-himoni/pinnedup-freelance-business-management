<?php

namespace App\Filament\Resources\ProposalsResource\Pages;

use App\Filament\Resources\ProposalsResource;
 use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProposals extends EditRecord
{
    protected static string $resource = ProposalsResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ViewAction::make(),
        ];
    }
}
