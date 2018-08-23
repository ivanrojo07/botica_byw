<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    //
    protected $table="facturas";

    protected $fillable=[
    	'id',
        'numero',
        'fecha',
        'codigo_prod',
        'nombre_prod',
        'codigo_bar',
        'clas_fis',
        'piezas',
        'prec_farm',
        'prec_bruto',
        'desc_oferta',
        'precio_desc',
        'desc_comercial',
        'prec_desc_comercial',
        'ieps',
        'iva',
        'bon_iva',
        'porc_utilidad',
        'neto',
        'neto_unit',
        'in_shopping_cart_id'
    ];

    protected $hidden=[
    	'created_at',
    	'updated_at'
    ];
    public function in_shopping_cart(){
    	return $this->belongsTo('App\InShoppingCart','in_shopping_cart_id');
    }
}
