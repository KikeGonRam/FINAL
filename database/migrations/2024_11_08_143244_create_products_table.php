<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    
     public function up()
     {
         Schema::create('products', function (Blueprint $table) {
             $table->id();
             $table->string('name'); // Nombre del producto
             $table->text('description')->nullable(); // Descripción del producto
             $table->decimal('price', 8, 2); // Precio del producto
             $table->string('image')->nullable(); // Imagen del producto
             $table->timestamps();
         });
     }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};