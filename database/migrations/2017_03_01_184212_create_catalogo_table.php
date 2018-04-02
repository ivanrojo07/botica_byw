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
            $table->integer('fecha_actual');
            $table->integer('codigo_marzam');
            $table->string('descripcion');
            $table->decimal('precio_farmacia',9,2);
            $table->decimal('precio_publico',9,2);
            $table->decimal('iva',5,2);
            $table->decimal('ieps',5,2);
            $table->decimal('impuesto_3', 5, 2);
            $table->string('tipo_de_producto');
            $table->string('laboratorio');
            $table->string('clasificacion_fiscal');
            $table->string('descripcion_terapeutica')->nullable();
            $table->string('sustancia_activa')->nullable();
            $table->string('refrigerado')->nullable();
            $table->string('controlado')->nullable();
            $table->bigInteger('codigo_de_barras')->nullable();
            $table->string('unidad_de_venta');
            $table->integer('fecha_de_caducidad');
            $table->integer('grupo_ssa');
            $table->String('accion_sobre_articulo')->nullable();
            $table->integer('pzas_empaque_original');
            $table->decimal('descuento_comercial',5,2);
            $table->integer('codigo_sat');
            $table->string('unidad_sat')->nullable();
            $table->integer('contador');
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
