<?php

namespace App\Filament\Resources\DokumentasiKerusakanResource\Pages;

use App\Filament\Resources\DokumentasiKerusakanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDokumentasiKerusakans extends ListRecords
{
    protected static string $resource = DokumentasiKerusakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
