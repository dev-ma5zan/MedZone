<?php

namespace App\Filament\Resources\SubAddressResource\Pages;

use App\Filament\Resources\SubAddressResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSubAddresses extends ListRecords
{
    protected static string $resource = SubAddressResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
