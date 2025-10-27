<x-filament-panels::page>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @if($juegoId)
        @livewire('juego-picas-fijas', ['juegoId' => $juegoId])
    @else
        <div style="text-align: center; padding: 3rem;">
            <h2 style="font-size: 1.5rem; color: #718096; margin-bottom: 1rem;">
                No se ha especificado un juego
            </h2>
            <p style="color: #a0aec0;">
                Por favor, accede a esta página con un ID de juego válido.
            </p>
        </div>
    @endif
</x-filament-panels::page>