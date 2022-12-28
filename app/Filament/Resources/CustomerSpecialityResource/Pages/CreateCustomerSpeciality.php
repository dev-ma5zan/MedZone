<?php

namespace App\Filament\Resources\CustomerSpecialityResource\Pages;

use App\Filament\Resources\CustomerSpecialityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerSpeciality extends CreateRecord
{
    protected static string $resource = CustomerSpecialityResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
