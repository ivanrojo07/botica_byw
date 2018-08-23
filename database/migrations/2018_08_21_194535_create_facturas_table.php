<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('facturas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numero');
            $table->date('fecha');
            $table->integer('codigo_prod');
            $table->string('nombre_prod');
            $table->string('codigo_bar');
            $table->string('clas_fis');
            $table->integer('piezas');
            $table->decimal('prec_farm');
            $table->decimal('prec_bruto');
            $table->decimal('desc_oferta');
            $table->decimal('precio_desc');
            $table->decimal('desc_comercial');
            $table->decimal('prec_desc_comercial');
            $table->decimal('ieps');
            $table->decimal('iva');
            $table->decimal('bon_iva');
            $table->decimal('porc_utilidad');
            $table->decimal('neto');
            $table->decimal('neto_unit');
            $table->integer('in_shopping_cart_id')->unsigned()->nullable();
            $table->foreign('in_shopping_cart_id')->references('id')->on('in_shopping_carts');
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
