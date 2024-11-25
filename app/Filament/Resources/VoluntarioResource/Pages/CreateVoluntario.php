<?php

namespace App\Filament\Resources\VoluntarioResource\Pages;

use App\Filament\Resources\VoluntarioResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateVoluntario extends CreateRecord
{
    protected static string $resource = VoluntarioResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index'); // Redirige al listado de voluntarios
    }
}
