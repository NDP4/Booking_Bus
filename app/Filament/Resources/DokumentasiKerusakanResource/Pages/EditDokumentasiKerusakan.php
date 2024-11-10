<?php

namespace App\Filament\Resources\DokumentasiKerusakanResource\Pages;

use App\Filament\Resources\DokumentasiKerusakanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDokumentasiKerusakan extends EditRecord
{
    protected static string $resource = DokumentasiKerusakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
