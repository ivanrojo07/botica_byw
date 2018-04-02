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
            $table->foreign('direccion_id')->unsigned()->nullable();
            $table->foreign('direccion_id')->references('id')->on('direccions');
            $table->decimal('total', 8, 2);
            $table->string('receta_path');
            $table->string('customid')->nullable();
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

