<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarbersTable extends Migration
{
    public function up()
    {
        Schema::create('barbers', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Columna para el nombre del barbero
            $table->string('email')->unique(); // Columna para el correo electrónico del barbero
            $table->string('photo')->nullable(); // Columna para la foto del barbero (opcional)
            $table->timestamps(); // Timestamps para created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('barbers');
    }
}