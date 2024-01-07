<?php

namespace App\Filament\Resources\WorkerFormResource\Pages;

use App\Filament\Resources\WorkerFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWorkerForms extends ListRecords
{
    protected static string $resource = WorkerFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
