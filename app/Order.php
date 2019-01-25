<?php



namespace App;





use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Mail;

use App\Mail\OrderCreated;



class Order extends Model {



    protected $fillable = [
        'recipient_name', 
        'line1', 
        'line2', 
        'city', 
        'country_code', 
        'state', 
        'postal_code',
        'email', 
        'shopping_cart_id', 
        'status', 
        'total', 
        'guide_numer', 
        'direccion_id', 
        'pedido_file', 
        'verificado',
        'pedido_at',
        'orden_compra_at',
        'empaquetado_at',
        'tracking_at',
        'entregado_at'

    ];



    public function sendMail()

    {

        Mail::to($this->email)->cc($this->shoppingcart->direccion->email)->send(new OrderCreated($this));

    }



    public function shoppingcart()

    {

        return $this->belongsTo('App\ShoppingCart', 'shopping_cart_id');

    }



    // public function scopeLatest($query)

    // {

    //     return $query->orderID()->monthly();

    // }



    public function scopeOrderID($query)

    {

        return $query->orderBy("id", "desc");

    }



    public function scopeMonthly($query)

    {

        return $query->whereMonth("created_at", "=", date('m'));

    }


    public static function total()

    {

        return Order::sum("total");

    }

    public static function totalMonth()

    {

        return Order::monthly()->sum("total");

    }

    public static function totalCount()

    {

        return Order::count();

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

        $orderData = [];



        $orderData["email"] = 'irojo@byw-si.com.mx';

        $orderData["total"] = $shopping_cart->total();

        $orderData["shopping_cart_id"] = $shopping_cart->id;

        $orderData['direccion_id'] = (!is_null($shopping_cart->direccion_id)) ? $shopping_cart->direccion_id : null;
        // $orderData['direccion_id'] = $shopping_cart->direccion_id;
        // $payer = $response->payer;



        // $orderData = (array) $payer->payer_info->shipping_address;



        // $orderData = $orderData[key($orderData)];



        // $orderData["email"] = $payer->payer_info->email;

        // $orderData["total"] = $shopping_cart->total();

        // $orderData["shopping_cart_id"] = $shopping_cart->id;

        // $orderData['direccion_id'] = (!is_null($shopping_cart->direccion_id)) ? $shopping_cart->direccion_id : 0;

        return Order::create($orderData);



    }

    public function trackings(){

        return $this->hasMany('App\Tracking','orden_id','id');
    }

   

}

