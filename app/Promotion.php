<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //

    protected $table = 'promotions';

    public $fillable = [
    	"fecha",
    	"codigo_marzam",
    	"nombre",
    	"precio_farmacia",
    	"precio_publico",
    	"iva",
    	"ieps",
    	"impuesto_3",
    	"constante",
    	"cantidad_base",
    	"cantidad_oferta",
    	"porcentaje_oferta",
    	"fecha_inicio",
    	"fecha_fin",
    	"codigo_barras",
    	// "tipo_oferta",
    	// "bolsa_oferta",
    	"descuento_comercial",
    	"numero_registro"
    ];
    protected $hidden = [
    	"created_at",
    	"updated_at"
    ];

     public function paypalItem()

    {

        $price = (is_object($this->cat) && $this->cat->slug == 'Promociones') ? $this->promotion_pricing :  $this->pivot->preciounit;



        return \PaypalPayment::item()->setName($this->nombre)

            ->setDescription($this->nombre)

            ->setCurrency('USD')

            ->setQuantity($this->pivot->qty)

            ->setPrice($this->pivot->preciounit);

    }



}
