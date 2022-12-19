<?php

namespace App\Filament\Resources\CustomerSpecialityResource\Pages;

use App\Filament\Resources\CustomerSpecialityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCustomerSpeciality extends ViewRecord
{
    protected static string $resource = CustomerSpecialityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
