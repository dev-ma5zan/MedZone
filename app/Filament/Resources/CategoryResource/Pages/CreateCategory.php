<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCategory extends CreateRecord
{
    protected static string $resource = CategoryResource::class;

    protected function beforeCreate()
    {
        $this->form->data['name'] = 'nothing';
        $parent_id = $this->data['parent_id'];
        if($parent_id)
        {
            $this->data['name'] = 'parent';
        }
        else
        {
            $this->data['name'] = 'not_parent';
        }
    }
}
