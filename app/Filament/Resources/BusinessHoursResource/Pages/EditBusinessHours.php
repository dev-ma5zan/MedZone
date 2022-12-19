<?php

namespace App\Filament\Resources\BusinessHoursResource\Pages;

use App\Filament\Resources\BusinessHoursResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBusinessHours extends EditRecord
{
    protected static string $resource = BusinessHoursResource::class;

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
