<?php

namespace App\Filament\Resources\PreferredBuyingMethodResource\Pages;

use App\Filament\Resources\PreferredBuyingMethodResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPreferredBuyingMethod extends ViewRecord
{
    protected static string $resource = PreferredBuyingMethodResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
