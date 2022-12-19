<?php

namespace App\Filament\Resources\VendorSpecialityResource\Pages;

use App\Filament\Resources\VendorSpecialityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVendorSpeciality extends ViewRecord
{
    protected static string $resource = VendorSpecialityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
