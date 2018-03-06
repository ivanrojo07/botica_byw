<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
     protected $table = 'tracking';
     protected $fillable=['shopping_cart_id',
 						  'orden_id',
 						  'hawb',
 						  'destino',
 						  'bultos',
 						  'peso'];

     public function hito(){

     	return $this->hasMany('App\StatusTracking', 'tracking_id');
     }
}
