<?php

namespace App\Filament\Resources\DecorResource\Pages;

use App\Filament\Resources\DecorResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDecor extends ViewRecord
{
    protected static string $resource = DecorResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
