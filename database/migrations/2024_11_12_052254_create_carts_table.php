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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Usuario dueño del carrito
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Referencia al producto
            $table->enum('estado', ['pendiente', 'pagado', 'completado'])->default('pendiente'); // Estado del carrito
            $table->integer('quantity')->default(1); // Cantidad del producto
            $table->decimal('price', 8, 2); // Precio del producto
            $table->decimal('total', 8, 2)->default(0); // Total del carrito
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};