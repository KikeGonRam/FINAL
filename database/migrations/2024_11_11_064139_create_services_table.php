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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');                      // Nombre del servicio
            $table->text('description');                 // Descripción del servicio
            $table->decimal('price', 8, 2);              // Precio en pesos mexicanos
            $table->integer('duration');                 // Duración estimada en minutos
            $table->boolean('special_dates')->default(0); // Disponibilidad para fechas especiales
            $table->json('specific_barbers')->nullable(); // Barberos específicos para el servicio
            $table->text('special_packages')->nullable(); // Paquetes especiales
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};