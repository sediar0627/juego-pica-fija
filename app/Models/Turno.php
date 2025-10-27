<?php

namespace App\Models;

use App\Events\TurnoCompletadoEvent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Turno extends Model
{
    protected $table = 'turnos';

    protected $fillable = [
        'juego_id',
        'jugador_id',
        'numero',
        'picas',
        'fijas',
    ];

    protected static function booted()
    {
        static::created(function (Turno $turno) {
            broadcast(new TurnoCompletadoEvent(
                juegoId: $turno->juego_id
            ))->toOthers();
        });
    }

    public function juego(): BelongsTo
    {
        return $this->belongsTo(Juego::class, 'juego_id');
    }

    public function jugador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'jugador_id');
    }
}
