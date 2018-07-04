<?php



namespace App;





use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Direccion extends Model {

	use SoftDeletes;



    protected $fillable = ['default'];

    protected $dates = ['deleted_at'];



    public function user()

    {

        return $this->belongsTo('App\User');

    }

    public function shopping_cart(){

    	return $this->hasOne('App\ShoppingCart');

    }

}

