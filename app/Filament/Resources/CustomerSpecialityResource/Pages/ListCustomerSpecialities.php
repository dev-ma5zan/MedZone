<?php

namespace App\Filament\Resources\CustomerSpecialityResource\Pages;

use App\Filament\Resources\CustomerSpecialityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCustomerSpecialities extends ListRecords
{
    protected static string $resource = CustomerSpecialityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
