<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('juegos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jugador_1_id')->constrained('users');
            $table->foreignId('jugador_2_id')->constrained('users');
            $table->boolean('jugador_1_turno')->default(true);
            $table->boolean('jugador_2_turno')->default(false);
            $table->string('numero_jugador_1')->nullable();
            $table->string('numero_jugador_2')->nullable();
            $table->foreignId('ganador_id')->nullable()->constrained('users');
            $table->string('estado')->default('sin_iniciar');
            $table->timestamps();

            $table->index(['jugador_1_id', 'jugador_2_id']);
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('juegos');
    }
};
