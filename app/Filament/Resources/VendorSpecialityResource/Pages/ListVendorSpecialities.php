<?php

namespace App\Filament\Resources\VendorSpecialityResource\Pages;

use App\Filament\Resources\VendorSpecialityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVendorSpecialities extends ListRecords
{
    protected static string $resource = VendorSpecialityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
