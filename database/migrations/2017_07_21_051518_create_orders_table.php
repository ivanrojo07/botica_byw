<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateOrdersTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('orders', function(Blueprint $table){ 

            $table->increments("id");

            $table->integer("shopping_cart_id")->unsigned();

            $table->foreign("shopping_cart_id")->references("id")->on("shopping_carts");
            $table->integer("direccion_id")->unsigned()->nullable();
            $table->foreign("direccion_id")->references("id")->on("direccions");

            $table->string('line1')->nullable(); 

            $table->string('line2')->nullable(); 

            $table->string('city')->nullable(); 

            $table->string('postal_code')->nullable(); 

            $table->string('country_code')->nullable(); 

            $table->string('state'); 

            $table->string('recipient_name'); 

            $table->string('email'); 

            $table->string('status')->default('creado'); 

            $table->string('guide_numer')->nullable(); 

            $table->decimal("total",8,2);

            $table->string('pedido_file')->nullable();

            $table->boolean('verificado')->default('0');

            $table->timestamp('pedido_at')->nullable();

            $table->timestamp('orden_compra_at')->nullable();

            $table->timestamp('empaquetado_at')->nullable();

            $table->timestamp('tracking_at')->nullable();

            $table->timestamp('entregado_at')->nullable();

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

        //

    }

}

