<?php

namespace App\Filament\Resources\Juegos;

use App\Filament\Resources\Juegos\Pages\CreateJuego;
use App\Filament\Resources\Juegos\Pages\EditJuego;
use App\Filament\Resources\Juegos\Pages\ListJuegos;
use App\Filament\Resources\Juegos\Schemas\JuegoForm;
use App\Filament\Resources\Juegos\Tables\JuegosTable;
use App\Models\Juego;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JuegoResource extends Resource
{
    protected static ?string $model = Juego::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Juegos';

    public static function form(Schema $schema): Schema
    {
        return JuegoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JuegosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJuegos::route('/'),
            'create' => CreateJuego::route('/create'),
            'edit' => EditJuego::route('/{record}/edit'),
        ];
    }
}
