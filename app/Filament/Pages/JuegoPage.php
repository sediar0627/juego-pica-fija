<?php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Page;

class JuegoPage extends Page
{
    protected string $view = 'filament.pages.juego-page';

    protected static string | BackedEnum | null $navigationIcon = 'heroicon-o-puzzle-piece';

    protected static ?string $navigationLabel = 'Jugar Picas y Fijas';

    protected static ?string $title = 'Juego de Picas y Fijas';

    public ?int $juegoId = null;

    public function mount(): void
    {
        // Obtener el ID del juego desde la URL
        $this->juegoId = request()->query('juego');
    }
}
