<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracking', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('shopping_cart_id')
            ->unsigned()
            ->references('id')
            ->on('shopping_carts');

            $table->integer('orden_id')
            ->unsigned()
            ->references('id')
            ->on('orders');

            $table->string('hawb')->unique();
            $table->string('destino');
            $table->tinyInteger('bultos')->unsigned()->nullable();
            $table->unsignedDecimal('peso', 8, 2)->nullable();

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
        Schema::dropIfExists('tracking');
    }
}
