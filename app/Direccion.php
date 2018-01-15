<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Direccion extends Model {

    protected $fillable = ['default'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function shopping_cart(){
    	return $this->belongsTo('App\ShoppingCart');
    }
}
