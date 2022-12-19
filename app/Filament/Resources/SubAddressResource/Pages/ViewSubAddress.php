<?php

namespace App\Filament\Resources\SubAddressResource\Pages;

use App\Filament\Resources\SubAddressResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSubAddress extends ViewRecord
{
    protected static string $resource = SubAddressResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
