<?php

namespace App\Filament\Resources\Juegos\Pages;

use App\Filament\Resources\Juegos\JuegoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJuegos extends ListRecords
{
    protected static string $resource = JuegoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
