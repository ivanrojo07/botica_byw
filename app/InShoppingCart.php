<?php



namespace App;





use Illuminate\Database\Eloquent\Model;



class InShoppingCart extends Model {



    protected $fillable = ["catalogo_id", "promotion_id", "preciounit", "shopping_cart_id", "qty"];



    public function shoppingcart()

    {

        return $this->belongsTo('App\ShoppingCart', 'shopping_cart_id');

    }



    public function product()

    {

        return $this->belongsTo('App\Catalogo', 'catalogo_id');

    }

    public function promotion(){
    	return $this->belongsTo('App\Promotion','promotion_id');
    }

    public function factura()
    {
        return $this->hasOne('App\Factura');
    }
}

