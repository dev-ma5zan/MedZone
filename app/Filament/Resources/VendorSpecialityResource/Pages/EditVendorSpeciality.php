<?php

namespace App\Filament\Resources\VendorSpecialityResource\Pages;

use App\Filament\Resources\VendorSpecialityResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVendorSpeciality extends EditRecord
{
    protected static string $resource = VendorSpecialityResource::class;

    protected function getActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
