<?php

namespace App\Filament\Resources\CrewSewaResource\Pages;

use App\Filament\Resources\CrewSewaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCrewSewas extends ListRecords
{
    protected static string $resource = CrewSewaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
