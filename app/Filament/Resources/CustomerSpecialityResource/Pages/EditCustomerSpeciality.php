<?php

namespace App\Filament\Resources\CustomerSpecialityResource\Pages;

use App\Filament\Resources\CustomerSpecialityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCustomerSpeciality extends EditRecord
{
    protected static string $resource = CustomerSpecialityResource::class;

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
