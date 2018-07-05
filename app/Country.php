<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //
    protected $table = 'country';
    protected $fillable=[
    	'id',
    	'iso',
    	'iso3',
    	'name',
    	'nicename',
    	'numcode',
    	'phonecode'
    ];
    protected $hidden=[
    	'created_at',
    	'updated_at'
    ];
    
}
