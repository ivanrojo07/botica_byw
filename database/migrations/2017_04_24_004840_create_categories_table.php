<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateCategoriesTable extends Migration {



    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('categories', function (Blueprint $table) {

                $table->increments('id');

                $table->string('title')->unique()->index();
                $table->string('slug')->index();
                $table->text('description')->nullable();

                $table->string('background_image')->nullable();

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

        Schema::dropIfExists('categories');

    }

}

