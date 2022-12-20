<?php

namespace App\Filament\Resources\PreferredBuyingMethodResource\Pages;

use App\Filament\Resources\PreferredBuyingMethodResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPreferredBuyingMethods extends ListRecords
{
    protected static string $resource = PreferredBuyingMethodResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
