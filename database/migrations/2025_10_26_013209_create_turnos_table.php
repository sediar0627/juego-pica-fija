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
        Schema::create('turnos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('juego_id')->constrained('juegos');
            $table->foreignId('jugador_id')->constrained('users');
            $table->string('numero');
            $table->integer('picas')->default(0);
            $table->integer('fijas')->default(0);
            $table->timestamps();

            $table->index(['juego_id', 'jugador_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnos');
    }
};
