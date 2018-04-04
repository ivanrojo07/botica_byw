<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ZonaEnvio extends Model
{
    //
    protected $table = "zona_envios";

    public $fillable= ['peso','precio_a','precio_b','precio_c','precio_d','precio_e','precio_f','precio_g','precio_h','precio_i'];

    public $protected= ['created_at','updated_at'];
}
