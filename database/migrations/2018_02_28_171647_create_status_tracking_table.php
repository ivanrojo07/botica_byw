<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusTrackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('status_tracking', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('tracking_id')
            ->unsigned()
            ->references('id')
            ->on('tracking');

            $table->date('fecha');
            $table->string('hora');

            $table->string('status');
           

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('status_tracking');
    }
}
