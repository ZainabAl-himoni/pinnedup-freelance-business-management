<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Invoice;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;

    protected function afterCreate(): void
    {
        Invoice::create([
            'amount' => 0,
            'status' => 'Pending',
            'task_id' => $this->record->id,
            'date' => now(),
        ]);
    }
}
