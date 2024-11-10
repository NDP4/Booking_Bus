<?php

namespace App\Filament\Resources\DokumentasiKerusakanResource\Pages;

use App\Filament\Resources\DokumentasiKerusakanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDokumentasiKerusakan extends CreateRecord
{
    protected static string $resource = DokumentasiKerusakanResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
