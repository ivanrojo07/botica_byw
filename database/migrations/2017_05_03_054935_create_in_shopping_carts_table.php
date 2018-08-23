<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateInShoppingCartsTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('in_shopping_carts', function(Blueprint $table){

            $table->increments("id");



            $table->integer('catalogo_id')->unsigned()->nullable();

            $table->integer('promotion_id')->unsigned()->nullable();

            $table->integer('shopping_cart_id')->unsigned();
            $table->integer('qty');
            $table->decimal('preciounit', 9,2);
            $table->boolean('empaquetado')->default('0');
            $table->boolean('comprado')->default('0');
            $table->boolean('pagado')->default('0');

            $table->foreign('catalogo_id')->references("id")->on("catalogo")->onDelete('cascade');
            $table->foreign('promotion_id')->references("id")->on("promotions")->onDelete('cascade');

            $table->foreign('shopping_cart_id')->references("id")->on("shopping_carts");

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

        Schema::dropIfExists('in_shopping_carts');





    }

}

