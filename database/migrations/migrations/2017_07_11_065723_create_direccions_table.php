<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDireccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direccions', function (Blueprint $table) {
            $table->increments("id");
            $table->integer("id_user")->unsigned(); 
            $table->foreign("id_user")->references("id")->on("users"); 
            $table->string('calle'); 
            $table->string('num_ext'); 
            $table->string('num_int'); 
            $table->string('entre1'); 
            $table->string('entre2'); 
            $table->text('references'); 
            $table->string('codigop'); 
            $table->string('colonia'); 
            $table->string('estado');
            $table->string('municipio');
            $table->string('ciudad');
            $table->string('pais');
            $table->string('email');
            $table->string('status')->default('creado'); 
            $table->string('guide_numer')->nullable(); 
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
        Schema::dropIfExists('direccions');
    }
}
