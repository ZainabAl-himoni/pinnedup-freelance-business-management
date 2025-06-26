<?php

namespace App\Filament\Resources\ProposalsResource\Pages;

use App\Filament\Resources\ProposalsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProposals extends ListRecords
{
    protected static string $resource = ProposalsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return 'All Proposals';
    }
}
