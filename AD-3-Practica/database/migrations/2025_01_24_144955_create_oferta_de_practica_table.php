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
        Schema::create('oferta_de_practica', function (Blueprint $table) {
            $table->id();
            // Relación con empresa (FK)
            $table->unsignedBigInteger('empresa_id');
            
            $table->string('puesto');
            $table->integer('duracion')->nullable();
            $table->text('requisitos')->nullable();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        
            // Definimos las FKs
            $table->foreign('empresa_id')->references('id')->on('empresa')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oferta_de_practica');
    }
};
