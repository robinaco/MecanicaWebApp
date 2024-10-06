<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Campo id autoincremental
            $table->string('codigoproducto'); // Código de producto (String)
            $table->string('categoriaproducto'); // Categoría de producto (String)
            $table->string('descripcionproducto'); // Descripción del producto (String)
            $table->integer('cantidadproducto'); // Cantidad del producto (Numérico)
            $table->decimal('valornetounidad', 10, 2); // Valor neto por unidad (Numérico)
            $table->decimal('valorventacomercial', 10, 2); // Valor de venta comercial (Numérico)
            $table->integer('estado')->default(1); //bandera para eliminar 
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
