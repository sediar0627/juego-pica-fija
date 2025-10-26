<div class="picas-fijas-container">
    <style>
        .picas-fijas-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }

        @media (min-width: 768px) {
            .picas-fijas-container {
                padding: 2rem;
            }
        }

        .game-header {
            background: white;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 768px) {
            .game-header {
                border-radius: 15px;
                padding: 1.5rem;
                margin-bottom: 2rem;
            }
        }

        .game-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
            text-align: center;
            margin-bottom: 1rem;
        }

        @media (min-width: 768px) {
            .game-title {
                font-size: 2rem;
            }
        }

        .game-info {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0.75rem;
            margin-top: 1rem;
        }

        @media (min-width: 640px) {
            .game-info {
                grid-template-columns: repeat(2, 1fr);
                gap: 1rem;
            }
        }

        .info-card {
            background: #f7fafc;
            padding: 0.875rem;
            border-radius: 0.75rem;
            text-align: center;
        }

        @media (min-width: 768px) {
            .info-card {
                padding: 1rem;
                border-radius: 10px;
            }
        }

        .info-label {
            font-size: 0.875rem;
            color: #718096;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 1rem;
            font-weight: 600;
            color: #2d3748;
        }

        @media (min-width: 768px) {
            .info-value {
                font-size: 1.125rem;
            }
        }

        .turn-indicator {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 0.875rem;
            border-radius: 0.75rem;
            text-align: center;
            font-weight: 600;
            margin-bottom: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            align-items: center;
        }

        @media (min-width: 640px) {
            .turn-indicator {
                flex-direction: row;
                justify-content: space-between;
                padding: 0.75rem;
                border-radius: 10px;
            }
        }

        .turn-indicator.my-turn {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        .refresh-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            font-size: 0.875rem;
            white-space: nowrap;
        }

        @media (min-width: 768px) {
            .refresh-btn {
                border-radius: 8px;
            }
        }

        .refresh-btn:hover {
            background: white;
            color: #667eea;
        }

        .my-number-section {
            background: white;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        @media (min-width: 768px) {
            .my-number-section {
                border-radius: 15px;
                padding: 1.5rem;
                margin-bottom: 2rem;
            }
        }

        .my-number-label {
            font-size: 0.875rem;
            color: #718096;
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        @media (min-width: 768px) {
            .my-number-label {
                font-size: 1rem;
                margin-bottom: 1rem;
            }
        }

        .my-number-display {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0.875rem;
            font-size: 1.5rem;
            border-radius: 0.75rem;
            letter-spacing: 0.5rem;
            font-weight: bold;
            display: inline-block;
            min-width: 200px;
            box-shadow: 0 4px 6px rgba(102, 126, 234, 0.3);
        }

        @media (min-width: 768px) {
            .my-number-display {
                padding: 1rem 2rem;
                font-size: 2rem;
                border-radius: 10px;
                letter-spacing: 0.75rem;
                min-width: 250px;
            }
        }

        .input-section {
            background: white;
            border-radius: 1rem;
            padding: 1rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 768px) {
            .input-section {
                border-radius: 15px;
                padding: 1.5rem;
                margin-bottom: 2rem;
            }
        }

        .input-form {
            display: flex;
            flex-direction: column;
            gap: 0.875rem;
            align-items: stretch;
        }

        @media (min-width: 640px) {
            .input-form {
                flex-direction: row;
                gap: 1rem;
                align-items: flex-start;
            }
        }

        .number-input {
            flex: 1;
            padding: 0.875rem;
            font-size: 1.25rem;
            border: 3px solid #e2e8f0;
            border-radius: 0.75rem;
            text-align: center;
            letter-spacing: 0.3rem;
            font-weight: bold;
            transition: all 0.3s;
            color: #2d3748;
        }

        @media (min-width: 768px) {
            .number-input {
                padding: 1rem;
                font-size: 1.5rem;
                border-radius: 10px;
                letter-spacing: 0.5rem;
            }
        }

        .number-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .number-input:disabled {
            background: #f7fafc;
            cursor: not-allowed;
        }

        .number-input::placeholder {
            color: #a0aec0;
        }

        .submit-btn {
            padding: 0.875rem 1.5rem;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 0.75rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            white-space: nowrap;
            font-size: 1rem;
        }

        @media (min-width: 768px) {
            .submit-btn {
                padding: 1rem 2rem;
                border-radius: 10px;
            }
        }

        .submit-btn:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .submit-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .message {
            margin-top: 1rem;
            padding: 0.75rem;
            border-radius: 0.5rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.875rem;
        }

        @media (min-width: 768px) {
            .message {
                border-radius: 8px;
                font-size: 1rem;
            }
        }

        .message.success {
            background: #c6f6d5;
            color: #22543d;
        }

        .message.error {
            background: #fed7d7;
            color: #742a2a;
        }

        .message.info {
            background: #bee3f8;
            color: #2c5282;
        }

        .turnos-table-container {
            background: white;
            border-radius: 1rem;
            padding: 1rem;
            max-height: 500px;
            overflow-y: auto;
            overflow-x: auto;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 768px) {
            .turnos-table-container {
                border-radius: 15px;
                padding: 1.5rem;
            }
        }

        .table-title {
            font-size: 1.125rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 1rem;
        }

        @media (min-width: 768px) {
            .table-title {
                font-size: 1.25rem;
            }
        }

        .turnos-table {
            width: 100%;
            border-collapse: collapse;
            min-width: 500px;
        }

        .turnos-table thead {
            background: #f7fafc;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .turnos-table th {
            padding: 0.75rem;
            text-align: left;
            font-weight: 600;
            color: #4a5568;
            border-bottom: 2px solid #e2e8f0;
            font-size: 0.875rem;
        }

        @media (min-width: 768px) {
            .turnos-table th {
                padding: 1rem;
                font-size: 1rem;
            }
        }

        .turnos-table td {
            padding: 0.75rem;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.875rem;
        }

        @media (min-width: 768px) {
            .turnos-table td {
                padding: 1rem;
                font-size: 1rem;
            }
        }

        .turnos-table tbody tr:hover {
            background: #f7fafc;
        }

        .numero-cell {
            font-size: 1rem;
            font-weight: bold;
            letter-spacing: 0.2rem;
            color: #667eea;
        }

        @media (min-width: 768px) {
            .numero-cell {
                font-size: 1.25rem;
                letter-spacing: 0.3rem;
            }
        }

        .badge {
            display: inline-block;
            padding: 0.25rem 0.625rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        @media (min-width: 768px) {
            .badge {
                padding: 0.25rem 0.75rem;
                font-size: 0.875rem;
            }
        }

        .badge-picas {
            background: #feebc8;
            color: #7c2d12;
        }

        .badge-fijas {
            background: #c6f6d5;
            color: #22543d;
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: #a0aec0;
        }

        @media (min-width: 768px) {
            .empty-state {
                padding: 3rem;
            }
        }

        .empty-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        @media (min-width: 768px) {
            .empty-icon {
                font-size: 3rem;
            }
        }

        .empty-state p {
            font-size: 0.875rem;
        }

        @media (min-width: 768px) {
            .empty-state p {
                font-size: 1rem;
            }
        }

        .game-over {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        @media (min-width: 768px) {
            .game-over {
                border-radius: 15px;
                padding: 2rem;
                margin-bottom: 2rem;
            }
        }

        .game-over-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        @media (min-width: 768px) {
            .game-over-icon {
                font-size: 4rem;
            }
        }

        .game-over h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
            color: #2d3748;
        }

        @media (min-width: 768px) {
            .game-over h2 {
                font-size: 2rem;
            }
        }

        .winner-card {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 1.25rem;
            border-radius: 1rem;
            display: inline-block;
            margin-top: 1rem;
            font-weight: 700;
            font-size: 1.125rem;
            box-shadow: 0 4px 6px rgba(240, 147, 251, 0.4);
        }

        @media (min-width: 768px) {
            .winner-card {
                padding: 1.5rem 2rem;
                border-radius: 15px;
                font-size: 1.5rem;
            }
        }

        .winner-card.you-won {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            box-shadow: 0 4px 6px rgba(79, 172, 254, 0.4);
        }

        .game-over-message {
            margin-top: 1rem;
            font-size: 1rem;
            color: #718096;
            font-weight: 500;
        }

        @media (min-width: 768px) {
            .game-over-message {
                font-size: 1.125rem;
            }
        }

        .numbers-reveal {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        @media (min-width: 640px) {
            .numbers-reveal {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .number-reveal-card {
            background: #f7fafc;
            padding: 1rem;
            border-radius: 0.75rem;
            border: 2px solid #e2e8f0;
        }

        @media (min-width: 768px) {
            .number-reveal-card {
                padding: 1.25rem;
                border-radius: 10px;
            }
        }

        .number-reveal-label {
            font-size: 0.875rem;
            color: #718096;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .number-reveal-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: #667eea;
            letter-spacing: 0.5rem;
        }

        @media (min-width: 768px) {
            .number-reveal-value {
                font-size: 2rem;
                letter-spacing: 0.75rem;
            }
        }

        /* Scrollbar personalizado */
        .turnos-table-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        .turnos-table-container::-webkit-scrollbar-track {
            background: #f7fafc;
            border-radius: 4px;
        }

        .turnos-table-container::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 4px;
        }

        .turnos-table-container::-webkit-scrollbar-thumb:hover {
            background: #a0aec0;
        }
    </style>

    <div class="game-header">
        <h1 class="game-title">🎯 Picas y Fijas</h1>
        
        <div class="game-info">
            <div class="info-card">
                <div class="info-label">Jugador 1</div>
                <div class="info-value">{{ $juego->jugador1->name }}</div>
            </div>
            <div class="info-card">
                <div class="info-label">Jugador 2</div>
                <div class="info-value">{{ $juego->jugador2->name }}</div>
            </div>
        </div>

        <div class="game-info" style="margin-top: 1rem;">
            <div class="info-card">
                <div class="info-label">Estado</div>
                <div class="info-value">
                    @if($juego->estado->value === 'sin_iniciar')
                        Sin Iniciar
                    @elseif($juego->estado->value === 'numeros_asignados')
                        Números Asignados
                    @elseif($juego->estado->value === 'en_progreso')
                        En Progreso
                    @else
                        Finalizado
                    @endif
                </div>
            </div>
            <div class="info-card">
                <div class="info-label">Total Turnos</div>
                <div class="info-value">{{ $misTurnos->count() }}</div>
            </div>
        </div>
    </div>

    @if($juego->estado->value === 'finalizado')
        <!-- Sección de Juego Finalizado -->
        <div class="game-over">
            <div class="game-over-icon">
                @if($juego->ganador_id === Auth::id())
                    🏆
                @else
                    😔
                @endif
            </div>
            <h2>¡Juego Finalizado!</h2>
            
            <div class="winner-card {{ $juego->ganador_id === Auth::id() ? 'you-won' : '' }}">
                @if($juego->ganador_id === Auth::id())
                    🎉 ¡Felicitaciones, has ganado!
                @else
                    Ganador: {{ $juego->ganador->name }}
                @endif
            </div>

            <p class="game-over-message">
                @if($juego->ganador_id === Auth::id())
                    Has logrado adivinar el número secreto de tu oponente
                @else
                    Tu oponente adivinó tu número secreto. ¡Mejor suerte la próxima vez!
                @endif
            </p>

            <!-- Revelar ambos números -->
            <div class="numbers-reveal">
                <div class="number-reveal-card">
                    <div class="number-reveal-label">Tu número:</div>
                    <div class="number-reveal-value">{{ $numeroJugador }}</div>
                </div>
                <div class="number-reveal-card">
                    <div class="number-reveal-label">Número del rival:</div>
                    <div class="number-reveal-value">{{ $numeroContrario }}</div>
                </div>
            </div>
        </div>
    @else
        <!-- Indicador de turno -->
        <div class="turn-indicator {{ $esMiTurno ? 'my-turn' : '' }}">
            <span>
                @if($esMiTurno)
                    ✨ Es tu turno - ¡Ingresa tu número!
                @else
                    ⏳ Esperando al otro jugador...
                @endif
            </span>
            <button wire:click="refrescar" class="refresh-btn" type="button">
                🔄 Actualizar
            </button>
        </div>

        <!-- Sección de input (solo visible durante el juego) -->
        <div class="input-section">
            <form wire:submit.prevent="ingresarNumero" class="input-form">
                <input 
                    type="text" 
                    wire:model="numero" 
                    class="number-input"
                    placeholder="0000"
                    maxlength="4"
                    pattern="[0-9]*"
                    inputmode="numeric"
                    {{ !$esMiTurno ? 'disabled' : '' }}
                >
                <button 
                    type="submit" 
                    class="submit-btn"
                    {{ !$esMiTurno ? 'disabled' : '' }}
                >
                    Enviar
                </button>
            </form>

            @if($mensaje)
                <div class="message {{ $esMiTurno ? 'info' : 'error' }}">
                    {{ $mensaje }}
                </div>
            @endif
        </div>
    @endif

    <div class="turnos-table-container">
        <h2 class="table-title">📊 Historial Mis Turnos</h2>
        
        @if($misTurnos->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">🎲</div>
                <p>Aún no has realizado ningún turno</p>
                <p style="margin-top: 0.5rem;">
                    ¡Comienza a adivinar el número del oponente!
                </p>
            </div>
        @else
            <table class="turnos-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Número</th>
                        <th>Picas</th>
                        <th>Fijas</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($misTurnos as $index => $turno)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="numero-cell">{{ $turno->numero }}</td>
                            <td>
                                <span class="badge badge-picas">
                                    🔶 {{ $turno->picas }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-fijas">
                                    ✅ {{ $turno->fijas }}
                                </span>
                            </td>
                            <td style="color: #718096; font-size: 0.75rem;">
                                {{ $turno->created_at->format('H:i:s') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Sección de Mi Número (solo visible durante el juego) -->
    @if($juego->estado->value !== 'finalizado')
    <div class="my-number-section">
        <div class="my-number-label">🔐 Mi Número Secreto</div>
        <div class="my-number-display">{{ $numeroJugador }}</div>
    </div>
    @endif

    <div class="turnos-table-container">
        <h2 class="table-title">📊 Historial Turnos del Rival</h2>

        @if($turnosContrario->isEmpty())
            <div class="empty-state">
                <div class="empty-icon">🎲</div>
                <p>El rival aún no ha realizado ningún turno</p>
                <p style="margin-top: 0.5rem;">
                    ¡Esperando a que el oponente juegue!
                </p>
            </div>
        @else
            <table class="turnos-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Número</th>
                        <th>Picas</th>
                        <th>Fijas</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($turnosContrario as $index => $turno)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="numero-cell">{{ $turno->numero }}</td>
                            <td>
                                <span class="badge badge-picas">
                                    🔶 {{ $turno->picas }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-fijas">
                                    ✅ {{ $turno->fijas }}
                                </span>
                            </td>
                            <td style="color: #718096; font-size: 0.75rem;">
                                {{ $turno->created_at->format('H:i:s') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>