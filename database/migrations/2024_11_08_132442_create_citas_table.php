<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id'); // Clave foránea referenciando la tabla `users`
            $table->unsignedBigInteger('barber_id'); // Clave foránea referenciando la tabla `barbers`
            $table->date('fecha');
            $table->time('hora');
            $table->enum('estado', ['pendiente', 'aceptada', 'cancelada'])->default('pendiente');
            $table->timestamps();

            // Definir las claves foráneas
            $table->foreign('cliente_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('barber_id')->references('id')->on('barbers')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('citas');
    }
};