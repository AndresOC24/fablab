<?php

namespace App\Filament\Resources\AreasResource\Pages;

use App\Filament\Resources\AreasResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAreas extends EditRecord
{
    protected static string $resource = AreasResource::class;

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
