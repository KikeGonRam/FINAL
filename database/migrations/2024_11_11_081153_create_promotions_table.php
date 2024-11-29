<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // En la migración de promociones
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nombre de la promoción
            $table->text('description'); // Descripción de la promoción
            $table->decimal('discount', 8, 2); // Descuento en porcentaje
            $table->date('start_date'); // Fecha de inicio de la promoción
            $table->date('end_date'); // Fecha de finalización de la promoción
            $table->enum('type', ['service', 'product', 'both']); // Tipo de promoción (servicio, producto o ambos)
            $table->boolean('is_for_regular_customers')->default(false); // Si la promoción es solo para clientes habituales
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
