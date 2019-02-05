<?php



use Illuminate\Support\Facades\Schema;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Database\Migrations\Migration;



class CreateDireccionsTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('direccions', function (Blueprint $table) {

            $table->increments("id");

            $table->integer("id_user")->unsigned()->nullable(); 

            $table->foreign("id_user")->references("id")->on("users");

            $table->string('name');

            $table->string('calle'); 

            $table->string('num_ext'); 

            $table->string('num_int')->nullable(); 

            $table->string('colonia')->nullable(); 

            $table->string('codigop')->nullable(); 

            $table->string('estado');

            $table->string('municipio');

            $table->string('ciudad');

            $table->string('pais');

            $table->string('entre1')->nullable(); 

            $table->string('entre2')->nullable(); 

            $table->text('references')->nullable(); 

            $table->string('contacto')->nullable();

            $table->string('email');

            $table->string('telefono');

            $table->string('status')->default('creado'); 

            $table->string('guide_numer')->nullable();

            $table->boolean('default')->default('0');

            $table->softDeletes();

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

        Schema::dropIfExists('direccions');

    }

}

