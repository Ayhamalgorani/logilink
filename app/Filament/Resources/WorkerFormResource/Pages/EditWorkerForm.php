<?php

namespace App\Filament\Resources\WorkerFormResource\Pages;

use App\Filament\Resources\WorkerFormResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWorkerForm extends EditRecord
{
    protected static string $resource = WorkerFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
