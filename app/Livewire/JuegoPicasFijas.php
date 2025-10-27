<?php

namespace App\Livewire;

use App\Enum\EstadoJuego;
use App\Models\Juego;
use App\Models\Turno;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class JuegoPicasFijas extends Component
{
    public Juego $juego;
    public string $numero = '';
    public string $mensaje = '';
    public bool $esJugador1;
    public bool $esMiTurno;

    public function mount($juegoId)
    {
        $this->juego = Juego::with(['jugador1', 'jugador2', 'turnos.jugador'])
            ->findOrFail($juegoId);
        
        // Verificar que el usuario es parte del juego
        if (Auth::id() !== $this->juego->jugador_1_id && Auth::id() !== $this->juego->jugador_2_id) {
            abort(403, 'No tienes acceso a este juego');
        }

        // Verificar que ambos números están definidos
        if (!$this->juego->numero_jugador_1 || !$this->juego->numero_jugador_2) {
            abort(400, 'Los números de ambos jugadores deben estar definidos antes de iniciar el juego');
        }

        // Si el juego está sin iniciar, cambiarlo a en progreso
        if ($this->juego->estado === EstadoJuego::SIN_INICIAR->value || 
            $this->juego->estado === EstadoJuego::NUMEROS_ASIGNADOS->value) {
            $this->juego->estado = EstadoJuego::EN_PROGRESO->value;
            $this->juego->save();
        }
        
        $this->esJugador1 = Auth::id() === $this->juego->jugador_1_id;
        $this->actualizarTurno();
    }

    public function ingresarNumero()
    {
        // Refrescar el juego para tener datos actualizados
        $this->juego->refresh();
        $this->actualizarTurno();

        // Validar que el juego no haya finalizado
        if ($this->juego->estado === EstadoJuego::FINALIZADO->value) {
            $this->mensaje = 'El juego ha finalizado';
            return;
        }

        // Validar que es el turno del jugador
        if (!$this->esMiTurno) {
            $this->mensaje = 'No es tu turno';
            return;
        }

        // Validar formato del número
        if (!$this->validarNumero($this->numero)) {
            $this->mensaje = 'Número inválido. Debe tener 4 dígitos sin repetir';
            return;
        }

        // Obtener el número del contrario
        $numeroContrario = $this->esJugador1 
            ? $this->juego->numero_jugador_2 
            : $this->juego->numero_jugador_1;

        // Calcular picas y fijas
        [$picas, $fijas] = $this->calcularPicasFijas($this->numero, $numeroContrario);

        // Crear el turno
        Turno::create([
            'juego_id' => $this->juego->id,
            'jugador_id' => Auth::id(),
            'numero' => $this->numero,
            'picas' => $picas,
            'fijas' => $fijas,
        ]);

        // Verificar si el jugador ganó
        if ($fijas === 4) {
            $this->juego->estado = EstadoJuego::FINALIZADO->value;
            $this->juego->ganador_id = Auth::id();
            $this->juego->save();
            $this->mensaje = '🎉 ¡Has ganado el juego!';
        } else {
            // Cambiar el turno
            $this->cambiarTurno();
            $this->juego->save();
            $this->mensaje = "Picas: {$picas} 🔶 | Fijas: {$fijas} ✅";
        }

        // Limpiar el input
        $this->numero = '';
        
        // Refrescar datos
        $this->juego->refresh();
        $this->actualizarTurno();
    }

    public function refrescar()
    {
        $this->juego->refresh();
        $this->juego->load(['jugador1', 'jugador2', 'turnos.jugador']);
        $this->actualizarTurno();
        $this->mensaje = 'Datos actualizados';
    }

    private function actualizarTurno(): void
    {
        $this->esMiTurno = $this->esJugador1 
            ? $this->juego->jugador_1_turno 
            : $this->juego->jugador_2_turno;
    }

    private function validarNumero(string $numero): bool
    {
        // Verificar longitud y que sea numérico
        if (strlen($numero) !== 4 || !ctype_digit($numero)) {
            return false;
        }

        // Verificar que no haya dígitos repetidos
        return count(array_unique(str_split($numero))) === 4;
    }

    private function calcularPicasFijas(string $numeroIngresado, string $numeroReal): array
    {
        $picas = 0;
        $fijas = 0;

        $digitosIngresados = str_split($numeroIngresado);
        $digitosReales = str_split($numeroReal);

        foreach ($digitosIngresados as $index => $digito) {
            if ($digito === $digitosReales[$index]) {
                $fijas++;
            } elseif (in_array($digito, $digitosReales)) {
                $picas++;
            }
        }

        return [$picas, $fijas];
    }

    private function cambiarTurno(): void
    {
        $this->juego->jugador_1_turno = !$this->juego->jugador_1_turno;
        $this->juego->jugador_2_turno = !$this->juego->jugador_2_turno;
    }

    public function render()
    {
        $misTurnos = $this->juego->turnos()
            ->where('jugador_id', Auth::id())
            ->get();

        // Obtener el número del jugador actual
        $numeroJugador = $this->esJugador1 
            ? $this->juego->numero_jugador_1 
            : $this->juego->numero_jugador_2;

        // Obtener el número del contrario
        $numeroContrario = $this->esJugador1 
            ? $this->juego->numero_jugador_2 
            : $this->juego->numero_jugador_1;

        // Obtener el ID del contrario
        $contrarioId = $this->esJugador1 
            ? $this->juego->jugador_2_id 
            : $this->juego->jugador_1_id;

        // Cargar los turnos del contrario
        $turnosContrario = $this->juego->turnos()
            ->where('jugador_id', $contrarioId)
            ->get();

        return view('livewire.juego-picas-fijas', [
            'misTurnos' => $misTurnos,
            'numeroJugador' => $numeroJugador,
            'numeroContrario' => $numeroContrario,
            'turnosContrario' => $turnosContrario,
        ]);
    }

    public function getListeners()
    {
        return [
            "echo:TurnoCompletadoEvent.{$this->juego->id},TurnoCompletadoEvent" => 'onTurnoCompletado',
        ];
    }

    public function onTurnoCompletado($event)
    {
        $this->refrescar();

        Notification::make()
            ->title('El juego ha sido actualizado')
            ->success()
            ->send();

        $this->dispatch('play-sound', [
            'sound' => 'bell'
        ]);
    }
}