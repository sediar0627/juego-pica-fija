<?php

namespace App\Models;

use App\Enum\EstadoJuego;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Juego extends Model
{
    protected $table = 'juegos';

    protected $fillable = [
        'jugador_1_id',
        'jugador_2_id',
        'jugador_1_turno',
        'jugador_2_turno',
        'numero_jugador_1',
        'numero_jugador_2',
        'ganador_id',
        'estado',
    ];

    protected $casts = [
        'jugador_1_turno' => 'boolean',
        'jugador_2_turno' => 'boolean',
        'estado' => EstadoJuego::class,
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($juego) {
            if (
                $juego->estado === EstadoJuego::SIN_INICIAR &&
                $juego->numero_jugador_1 != null &&
                $juego->numero_jugador_2 != null
            ) {
                $juego->estado = EstadoJuego::NUMEROS_ASIGNADOS;
                $juego->save();
            }

            if (
                $juego->estado === EstadoJuego::NUMEROS_ASIGNADOS &&
                (
                    !$juego->numero_jugador_1 ||
                    !$juego->numero_jugador_2
                )
            ) {
                $juego->estado = EstadoJuego::SIN_INICIAR;
                $juego->save();
            }
        });
    }

    public function jugador1(): BelongsTo
    {
        return $this->belongsTo(User::class, 'jugador_1_id');
    }
    
    public function jugador2(): BelongsTo
    {
        return $this->belongsTo(User::class, 'jugador_2_id');
    }

    public function ganador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'ganador_id');
    }

    public function turnos(): HasMany
    {
        return $this->hasMany(Turno::class, 'juego_id');
    }

    public function esEditable(): bool
    {
        return in_array($this->estado, [
            EstadoJuego::SIN_INICIAR, 
            EstadoJuego::NUMEROS_ASIGNADOS
        ]);
    }
}
