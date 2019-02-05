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

        $price = (is_object($this->cat) && $this->cat->slug == 'Promociones') ? $this->promotion_pricing :  $this->pivot->preciounit;



        return \PaypalPayment::item()->setName($this->descripcion)

            ->setDescription($this->descripcion)

            ->setCurrency('USD')

            ->setQuantity($this->pivot->qty)

            ->setPrice($this->pivot->preciounit);

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

     public function getPesoAttribute(){
        $kg=strpos($this->descripcion,'KG');
        $g= strpos($this->descripcion, 'G');
        $mg =  strpos($this->descripcion, 'MG');
        if ($kg) {
            $cadena = substr($this->descripcion, 0, $kg);
            $numero = $this->getNumeros($cadena);
            return ['peso'=>$numero,'medida'=>'Kilogramos'];
        } 
        elseif($mg){
            $cadena = substr($this->descripcion, 0, $mg);
            $numero = $this->getNumeros($cadena);
            // dd($numero);
            $numero = $numero/100000;
            return ['peso'=>$numero,'medida'=>'Kilogramos'];
        }
        else {
            if($g){
                $cadena = substr($this->descripcion, 0, $g);
                $numero = $this->getNumeros($cadena);
                $numero = $numero/1000;
                return ['peso'=>$numero,'medida'=>'kilogramos'];
            }
            else{
                return ['peso'=>0,'medida'=>'Indefinido'];;
            }
        }
    }
    public function getNumeros($string)
    {
        preg_match_all('/\d+/', $string, $matches);
        return end($matches[0]);
    }

}
