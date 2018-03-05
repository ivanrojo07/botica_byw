<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogo extends Model
{
    //
    protected $table = 'catalogo';

    public $fillable = [
    	"fecha_actual","codigo_marzam","descripcion","precio_farmacia","precio_publico","iva","ieps","impuesto_3","tipo_de_producto","laboratorio","clasificacion_fiscal","descripcion_terapeutica","sustancia_activa","refrigerado","controlado","codigo_de_barras","unidad_de_venta","fecha_de_caducidad","grupo_ssa","accion_sobre_articulo","pzas_empaque_original","descuento_comercial","codigo_sat","_unidad_sat","contador"
    ];

    // public $hidden = [ 'created_at', 'updated_at'];

    public function cat()

    {

        return $this->belongsTo('App\Category', 'category_id');

    }



    public function paypalItem()

    {

        $price = (is_object($this->cat) && $this->cat->slug == 'Promociones') ? $this["precio_publico"] :  $this["precio_publico"];



        return \PaypalPayment::item()->setName($this["descripcion"])

            ->setDescription($this["descripcion_terapeutica"])

            ->setCurrency('USD')

            ->setQuantity($this->pivot->qty)

            ->setPrice($price);

    }



    public function scopeLatest($query)

    {

        return $query->orderBy("id", "desc");

    }



    public function scopeSearch($query, $title)

    {

        return $query->where('descripcion', 'like', '%' . $title . '%');



    }



    public function favorite_users()

    {

        return $this->belongsToMany('App\User', 'user_favorite_products', 'catalogo_id', 'user_id');

    }
}
