<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('country', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iso');
            $table->string('iso3');
            $table->string('name');
            $table->string('nicename');
            $table->integer('numcode');
            $table->integer('phonecode');
         });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
