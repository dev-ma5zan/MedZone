<?php

namespace App\Filament\Resources\BusinessHoursResource\Pages;

use App\Filament\Resources\BusinessHoursResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewBusinessHours extends ViewRecord
{
    protected static string $resource = BusinessHoursResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
