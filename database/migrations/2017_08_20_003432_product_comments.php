<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class ProductComments extends Migration {



    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('product_comments', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('user_id')->unsigned();

            $table->integer('catalogo_id')->unsigned();

            $table->text('comment');

            $table->boolean('approved')->default('0');

            $table->timestamps();

        });



        Schema::table('product_comments', function (Blueprint $table) {

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('catalogo_id')->references('id')->on('catalogo')->onDelete('cascade');

        });

    }



    /**

     * Reverse the migrations.

     *

     * @return void

     */

    public function down()

    {

        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('product_comments');

        Schema::enableForeignKeyConstraints();

    }

}

