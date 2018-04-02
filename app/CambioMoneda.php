<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CambioMoneda extends Model
{
    //
    protected $table = 'cambio_moneda';

    public $fillable = ['id','pesos'];

    protected $hidden =['created_at','updated_at'];
}
