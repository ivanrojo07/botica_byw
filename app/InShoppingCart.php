<?php



namespace App;





use Illuminate\Database\Eloquent\Model;



class InShoppingCart extends Model {



    protected $fillable = ["product_id", "shopping_cart_id", "qty"];



    public function shoppingcart()

    {

        return $this->belongsTo('App\ShoppingCart', 'shopping_cart_id');

    }



    public function product()

    {

        return $this->belongsTo('App\Product', 'product_id');

    }

    



}

