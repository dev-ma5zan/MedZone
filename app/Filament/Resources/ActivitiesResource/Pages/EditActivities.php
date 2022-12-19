<?php

namespace App\Filament\Resources\ActivitiesResource\Pages;

use App\Filament\Resources\ActivitiesResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditActivities extends EditRecord
{
    protected static string $resource = ActivitiesResource::class;

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