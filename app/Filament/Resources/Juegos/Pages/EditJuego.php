<?php

namespace App\Filament\Resources\Juegos\Pages;

use App\Filament\Resources\Juegos\JuegoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJuego extends EditRecord
{
    protected static string $resource = JuegoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
