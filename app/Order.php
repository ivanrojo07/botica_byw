<?php



namespace App;





use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Mail;

use App\Mail\OrderCreated;



class Order extends Model {



    protected $fillable = ['recipient_name', 'line1', 'line2', 'city', 'country_code', 'state', 'postal_code',

        'email', 'shopping_cart_id', 'status', 'total', 'guide_number', 'direccion_id'];



    public function sendMail()

    {

        Mail::to("ivanrojo07@gmail.com")->send(new OrderCreated($this));

    }



    public function shoppingcart()

    {

        return $this->belongsTo('App\ShoppingCart', 'shopping_cart_id','id');

    }



    public function scopeLatest($query)

    {

        return $query->orderID()->monthly();

    }



    public function scopeOrderID($query)

    {

        return $query->orderBy("id", "desc");

    }



    public function scopeMonthly($query)

    {

        return $query->whereMonth("created_at", "=", date('m'));

    }



    public static function totalMonth()

    {

        return Order::monthly()->sum("total");

    }



    public static function totalMonthCount()

    {

        return Order::monthly()->count();

    }





    public function address()

    {

        return "$this->line1 $this->line2";

    }



    public static function createFromPayPalResponse($response, $shopping_cart)

    {

        $payer = $response->payer;



        $orderData = (array) $payer->payer_info->shipping_address;



        $orderData = $orderData[key($orderData)];



        $orderData["email"] = $payer->payer_info->email;

        $orderData["total"] = $shopping_cart->total();

        $orderData["shopping_cart_id"] = $shopping_cart->id;

        $orderData['direccion_id'] = (!is_null($shopping_cart->direccion_id)) ? $shopping_cart->direccion_id : 0;

        return Order::create($orderData);



    }

    public function trackings(){

        return $this->hasMany('App\Tracking','orden_id','id');
    }

   

}

