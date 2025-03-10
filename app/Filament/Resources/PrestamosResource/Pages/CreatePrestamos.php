<?php

namespace App\Filament\Resources\PrestamosResource\Pages;

use App\Filament\Resources\PrestamosResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePrestamos extends CreateRecord
{
    protected static string $resource = PrestamosResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // Redirige al listado de voluntarios
    }
}
