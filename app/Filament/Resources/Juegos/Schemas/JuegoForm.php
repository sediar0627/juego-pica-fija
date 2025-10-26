<?php

namespace App\Filament\Resources\Juegos\Schemas;

use App\Enum\EstadoJuego;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class JuegoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('jugador_1_id')
                    ->relationship('jugador1', 'name')
                    ->required(),
                Select::make('jugador_2_id')
                    ->relationship('jugador2', 'name')
                    ->required(),
            ]);
    }
}
