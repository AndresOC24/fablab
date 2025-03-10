<?php

namespace App\Filament\Resources\MaquinasResource\Pages;

use App\Filament\Resources\MaquinasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMaquinas extends EditRecord
{
    protected static string $resource = MaquinasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // Redirige al listado de voluntarios
    }

}
