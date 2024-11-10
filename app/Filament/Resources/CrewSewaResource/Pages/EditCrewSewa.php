<?php

namespace App\Filament\Resources\CrewSewaResource\Pages;

use App\Filament\Resources\CrewSewaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCrewSewa extends EditRecord
{
    protected static string $resource = CrewSewaResource::class;

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
