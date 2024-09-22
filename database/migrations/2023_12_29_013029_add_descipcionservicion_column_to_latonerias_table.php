<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescipcionservicionColumnToLatoneriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('latonerias', function (Blueprint $table) {
            $table->string('conceptoservicio',500);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('latonerias', function (Blueprint $table) {
            $table->dropColumn('conceptoservicio');
        });
    }
}
