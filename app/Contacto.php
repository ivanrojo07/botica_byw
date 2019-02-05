<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    //

    protected $fillable=[
    	'nombre',
    	'codigo_pais',
    	'telefono',
    	'email'
    ];

   	protected $hidden=[
   		'created_at',
   		'updated_at'
   	];

   	public function shoppingCart()
   	{
   		return $this->belognsTo('App\ShoppingCart');
   	}
}
