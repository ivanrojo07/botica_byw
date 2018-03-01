<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogo', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Fecha Actual');
            $table->integer('Codigo Marzam');
            $table->string('Descripcion');
            $table->decimal('Precio Farmacia',9,2);
            $table->decimal('Precio Publico',9,2);
            $table->decimal('% IVA',5,2);
            $table->decimal('% IEPS',5,2);
            $table->decimal('Impuesto 3', 5, 2);
            $table->string('Tipo de Producto');
            $table->string('Laboratorio');
            $table->string('Clasificacion Fiscal');
            $table->string('Descripcion Terapeutica')->nullable();
            $table->string('Sustancia Activa')->nullable();
            $table->string('Refrigerado')->nullable();
            $table->string('Controlado')->nullable();
            $table->bigInteger('Codigo de Barras');
            $table->string('Unidad de Venta');
            $table->integer('fecha de Caducidad');
            $table->integer('Grupo SSA');
            $table->String('Accion Sobre Articulo')->nullable();
            $table->integer('Pzas Empaque Original');
            $table->decimal('Descuento Comercial %',5,2);
            $table->integer('Codigo SAT');
            $table->string('Unidad SAT');
            $table->integer('Contador');
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
        Schema::dropIfExists('catalogo');
    }
}
