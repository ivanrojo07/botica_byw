<?php



namespace App;





use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Direccion extends Model {

	use SoftDeletes;



    protected $fillable = [
        'name',
        'calle',
        'num_ext',
        'num_int',
        'colonia',
        'codigop',
        'estado',
        'municipio',
        'ciudad',
        'pais',
        'entre1',
        'entre2',
        'references',
        'contacto',
        'email',
        'telefono',
        'status',
        'guide_numer',
        'default'
    ];

    protected $dates = ['deleted_at'];



    public function user()

    {

        return $this->belongsTo('App\User');

    }

    public function shopping_cart(){

    	return $this->hasOne('App\ShoppingCart');

    }

}

