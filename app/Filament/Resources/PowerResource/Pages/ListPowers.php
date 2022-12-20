<?php

namespace App\Filament\Resources\PowerResource\Pages;

use App\Filament\Resources\PowerResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPowers extends ListRecords
{
    protected static string $resource = PowerResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
