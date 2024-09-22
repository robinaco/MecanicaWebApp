<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();  
            $table->integer('pkvehiculo');
            $table->uuid('ordenlatoneria');
            $table->string('modelo', 20);
            $table->string('color',50);
            $table->string('nivelfuel',50);
            $table->string('antena',10);
            $table->string('extintor',10);
            $table->string('gato',10);
            $table->string('llanta',10);
            $table->string('herramientas',10);
            $table->string('kit',10);
            $table->string('documentos',10);
            $table->string('radio',10);
            $table->string('parlantes',10);
            $table->string('tapetes',10);
            $table->string('encendedor',10);
            $table->string('espejos',10);
            $table->string('parasoles',10);
            $table->string('limpiabrisas',10);
            $table->string('bateria',10);
            $table->string('pinturafogueada',10);
            $table->string('suciedad',10);
            $table->string('Descripcionactividad',1000);
            $table->string('valorcosto',250);
            $table->string('valorabono',250);
            $table->string('valorrestante',10);
            $table->string('operario',100);
            $table->string('usuario',100);
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
        Schema::dropIfExists('inventarios');
    }
}
