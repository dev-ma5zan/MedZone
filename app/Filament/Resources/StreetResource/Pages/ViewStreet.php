<?php

namespace App\Filament\Resources\StreetResource\Pages;

use App\Filament\Resources\StreetResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewStreet extends ViewRecord
{
    protected static string $resource = StreetResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
