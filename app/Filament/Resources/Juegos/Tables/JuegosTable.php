<?php

namespace App\Filament\Resources\Juegos\Tables;

use App\Enum\EstadoJuego;
use App\Models\Juego;
use Closure;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class JuegosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),
                TextColumn::make('jugador1.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('jugador2.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('numero_jugador_1')
                    ->label('Número Jugador')
                    ->formatStateUsing(function (Juego $record) {
                        $usuarioAutenticado = Auth::user();
                        
                        if ($record->jugador_1_id === $usuarioAutenticado->id) {
                            return $record->numero_jugador_1 ?? 'No asignado';
                        } elseif ($record->jugador_2_id === $usuarioAutenticado->id) {
                            return $record->numero_jugador_2 ?? 'No asignado';
                        }

                        return 'No disponible';
                    }),
                TextColumn::make('ganador.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estado')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->visible(fn (Juego $record): bool => $record->esEditable()),

                Action::make('updateNumeroJugador')
                    ->label('Asignar Numero')
                    ->icon(Heroicon::NumberedList)
                    ->schema([
                        TextInput::make('numero_jugador')
                            ->label('Numero')
                            ->default(function (Juego $record) {
                                $usuarioAutenticado = Auth::user();
                                
                                if ($record->jugador_1_id === $usuarioAutenticado->id) {
                                    return $record->numero_jugador_1;
                                } elseif ($record->jugador_2_id === $usuarioAutenticado->id) {
                                    return $record->numero_jugador_2;
                                }

                                return null;
                            })
                            ->rules([
                                'required',
                                'string',
                                'size:4',
                                'regex:/^\d{4}$/',
                                fn (): Closure => function (string $attribute, $value, Closure $fail) {
                                    $valueArray = str_split($value);

                                    if (count(array_unique($valueArray)) < 4) {
                                        $fail('El número debe tener 4 dígitos únicos.');
                                    }
                                },
                            ]),
                    ])
                    ->requiresConfirmation()
                    ->action(function (array $data, Juego $record): void {
                        $usuarioAutenticado = Auth::user();
                        
                        if ($record->jugador_1_id === $usuarioAutenticado->id) {
                            $record->numero_jugador_1 = $data['numero_jugador'];
                        } elseif ($record->jugador_2_id === $usuarioAutenticado->id) {
                            $record->numero_jugador_2 = $data['numero_jugador'];
                        }

                        $record->save();
                    })
                    ->visible(fn (Juego $record): bool => 
                        (
                            Auth::user()->id === $record->jugador_1_id || 
                            Auth::user()->id === $record->jugador_2_id
                        ) && 
                        $record->esEditable()
                    ),

                Action::make('comenzarJuego')
                    ->label('Comenzar Juego')
                    ->icon(Heroicon::Play)
                    ->requiresConfirmation()
                    ->action(function (Juego $record): void {
                        $record->estado = EstadoJuego::EN_PROGRESO;
                        $record->save();
                    })
                    ->visible(fn (Juego $record): bool => 
                        (
                            Auth::user()->id === $record->jugador_1_id || 
                            Auth::user()->id === $record->jugador_2_id
                        ) && 
                        $record->numero_jugador_1 && 
                        $record->numero_jugador_2 &&
                        $record->estado === EstadoJuego::NUMEROS_ASIGNADOS
                    ),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
