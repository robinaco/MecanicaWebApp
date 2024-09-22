<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('idvehiculo');
            $table->uuid('ordenservicio');
            $table->string('mecanico', 200);
            $table->string('conceptomano',50);
            $table->string('conceptotipo',50);
            $table->integer('valormano');
            $table->integer('cantidad');
            $table->string('describemano',600);
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
        Schema::dropIfExists('services');
    }
}
