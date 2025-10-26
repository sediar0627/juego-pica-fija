<?php

namespace App\Enum;

enum EstadoJuego: string
{
    case SIN_INICIAR = 'sin_iniciar';
	case NUMEROS_ASIGNADOS = 'numeros_asignados';
	case EN_PROGRESO = 'en_progreso';
	case FINALIZADO = 'finalizado';
}
