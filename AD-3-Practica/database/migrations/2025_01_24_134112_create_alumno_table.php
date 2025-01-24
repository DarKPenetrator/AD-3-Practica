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
        Schema::create('alumno', function (Blueprint $table) {
            $table->id();
            // Relación con users (FK)
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('centro_educativo_id')->nullable();
            $table->string('carrera');
            // year se puede hacer con integer o year. Muchas veces se pone integer
            $table->integer('año_graduacion')->nullable();
            $table->string('telefono')->nullable();
            $table->timestamps();
        
            // Definimos las FKs
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('centro_educativo_id')->references('id')->on('centro_educativo')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alumno');
    }
};
