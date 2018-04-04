<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonaEnvioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zona_envios', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->decimal('peso',4,2)->unique();
            $table->decimal('precio_a',6,2);
            $table->decimal('precio_b',6,2);
            $table->decimal('precio_c',6,2);
            $table->decimal('precio_d',6,2);
            $table->decimal('precio_e',6,2);
            $table->decimal('precio_f',6,2);
            $table->decimal('precio_g',6,2);
            $table->decimal('precio_h',6,2);
            $table->decimal('precio_i',6,2);
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
        
        Schema::dropIfExists('zona_envios');
        
    }
}
