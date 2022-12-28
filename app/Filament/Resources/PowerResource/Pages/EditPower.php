<?php

namespace App\Filament\Resources\PowerResource\Pages;

use App\Filament\Resources\PowerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPower extends EditRecord
{
    protected static string $resource = PowerResource::class;

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
