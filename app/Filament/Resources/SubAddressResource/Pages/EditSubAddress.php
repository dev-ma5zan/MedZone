<?php

namespace App\Filament\Resources\SubAddressResource\Pages;

use App\Filament\Resources\SubAddressResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSubAddress extends EditRecord
{
    protected static string $resource = SubAddressResource::class;

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
