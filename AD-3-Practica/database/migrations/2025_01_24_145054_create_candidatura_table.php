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
        Schema::create('candidatura', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alumno_id');
            $table->unsignedBigInteger('oferta_de_practica_id');
            $table->unsignedBigInteger('tutor_id')->nullable();
            $table->enum('estado', ['pendiente','aceptada','rechazada'])->default('pendiente');
            $table->text('comentarios')->nullable();
            $table->date('fecha_candidatura')->nullable();
            $table->timestamps();
        
            $table->foreign('alumno_id')->references('id')->on('alumno')->onDelete('cascade');
            $table->foreign('oferta_de_practica_id')->references('id')->on('oferta_de_practica')->onDelete('cascade');
            $table->foreign('tutor_id')->references('id')->on('tutor')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('candidatura');
    }
};
