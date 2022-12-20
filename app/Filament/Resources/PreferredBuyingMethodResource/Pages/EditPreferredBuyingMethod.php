<?php

namespace App\Filament\Resources\PreferredBuyingMethodResource\Pages;

use App\Filament\Resources\PreferredBuyingMethodResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPreferredBuyingMethod extends EditRecord
{
    protected static string $resource = PreferredBuyingMethodResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
