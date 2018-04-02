<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
     protected $table = 'tracking';
     protected $fillable=['id',
 						  'orden_id',
 						  'hawb',
 						  'destino',
 						  'bultos',
 						  'peso'];

     public function hito(){

     	return $this->hasMany('App\StatusTracking', 'tracking_id');
     }

     public function orden(){
     	return $this->belongsTo('App\Order','orden_id');
     }

    // public function shoppingCart(){
    //  	return $this->belongsTo('App\ShoppingCart', 'id', 'shopping_cart_id');
    //  }
}
