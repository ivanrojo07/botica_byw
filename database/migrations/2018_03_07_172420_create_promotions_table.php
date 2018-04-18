<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fecha');
            $table->integer('codigo_marzam');
            $table->string('nombre');
            $table->decimal('precio_farmacia',8,2);
            $table->decimal('precio_publico',8,2);
            $table->decimal('iva',5,2);
            $table->decimal('ieps',5,2);
            $table->decimal('impuesto_3',5,2)->nullable();
            $table->string('constante')->nullable();
            $table->integer('cantidad_base');
            $table->integer('cantidad_oferta');
            $table->decimal('porcentaje_oferta',5,2);
            $table->integer('fecha_inicio');
            $table->integer('fecha_fin');
            $table->bigInteger('codigo_barras')->nullable();
            // $table->string('tipo_oferta');
            // $table->string('bolsa_oferta');
            $table->decimal('descuento_comercial',5,2);
            $table->integer('numero_registro');
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
        Schema::dropIfExists('promotions');
    }
}
