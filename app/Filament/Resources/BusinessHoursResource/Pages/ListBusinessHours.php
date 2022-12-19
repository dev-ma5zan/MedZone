<?php

namespace App\Filament\Resources\BusinessHoursResource\Pages;

use App\Filament\Resources\BusinessHoursResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBusinessHours extends ListRecords
{
    protected static string $resource = BusinessHoursResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
