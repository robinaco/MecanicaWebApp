<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('tools', function (Blueprint $table) {
                $table->id();  // Ya incluye AUTO_INCREMENT y PRIMARY KEY
                $table->string('categoriaherramienta', 100);
                $table->string('descripcionherramienta', 2000);
                $table->integer('valorcompraneto');
                $table->integer('cantidad');
                $table->integer('valorventa');
                $table->integer('estado');
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tools');
    }
}
