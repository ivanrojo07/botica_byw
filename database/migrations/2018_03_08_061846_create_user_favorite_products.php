<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateUserFavoriteProducts extends Migration {



    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('user_favorite_products', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('user_id')->unsigned()->nullable();

            $table->integer('catalogo_id')->unsigned()->nullable();

            $table->timestamps();

        });



        Schema::table('user_favorite_products', function (Blueprint $table) {

            $table->foreign('user_id')->references('id')->on('users');

            $table->foreign('catalogo_id')->references('id')->on('catalogo');

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

        Schema::dropIfExists('user_favorite_products');

        Schema::enableForeignKeyConstraints();

    }

}

