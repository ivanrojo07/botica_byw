<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateShoppingCartsTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('shopping_carts', function(Blueprint $table){

            $table->increments("id");



            $table->string('status');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('direccion_id')->unsigned()->nullable();
            $table->foreign('direccion_id')->references('id')->on('direccions');
            $table->decimal('total', 8, 2)->default('0.00');
            $table->decimal('totalenvio',8,2)->default('0.00');
            $table->decimal('peso',8,2,6)->default('0.00');
            $table->string('receta_path');
            $table->string('customid')->nullable()->unique();
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

        Schema::drop('shopping_carts');

    }

}

