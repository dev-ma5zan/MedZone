<?php

namespace App\Filament\Resources\VendorSpecialityResource\Pages;

use App\Filament\Resources\VendorSpecialityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVendorSpeciality extends CreateRecord
{
    protected static string $resource = VendorSpecialityResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
