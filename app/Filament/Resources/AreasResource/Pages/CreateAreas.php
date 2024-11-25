<?php

namespace App\Filament\Resources\AreasResource\Pages;

use App\Filament\Resources\AreasResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAreas extends CreateRecord
{
    protected static string $resource = AreasResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // Redirige al listado de voluntarios
    }
}
