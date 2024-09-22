<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLatoneriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('latonerias', function (Blueprint $table) {
            $table->id();
            $table->integer('idvehiculo');
            $table->uuid('ordenl');
            $table->string('descripcionservicio', 50);
            $table->string('cantidad',50);
            $table->string('preciounidad',250);
            $table->string('subtotal',250);
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
        Schema::dropIfExists('latonerias');
    }
}
