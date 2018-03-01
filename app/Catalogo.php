<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    //
    protected $table = 'catalogo';

    public $fillable = [
    	"Fecha Actual","Codigo Marzam","Descripcion","Precio Farmacia","Precio Publico","% IVA","% IEPS","Impuesto 3","Tipo de Producto","Laboratorio","Clasificacion Fiscal","Descripcion Terapeutica","Sustancia Activa","Refrigerado","Controlado","Codigo de Barras","Unidad de Venta","Fecha de Caducidad","Grupo SSA","Accion Sobre Articulo","Pzas. Empaque Original","Descuento Comercial %","Codigo SAT"," Unidad SAT","Contador"
    ];
}
