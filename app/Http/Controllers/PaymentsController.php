<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use App\ShoppingCart;

use App\Paypal;

use App\Order;



class PaymentsController extends Controller

{

     public function store(Request $request){

        $shopping_cart_id = \Session::get('shopping_cart_id');



        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);


        // Pruebas
        \Session::remove('shopping_cart_id');
        $response=['payer'=>"payer"];
        $order = Order::createFromPayPalResponse($response,$shopping_cart);
        // $order = Order::first();
        $shopping_cart = $order->shoppingcart;
        // dd($shopping_cart);
        

        $shopping_cart->approve();

        $order->sendMail();


        // Paypal
        // $paypal = new Paypal($shopping_cart,$shopping_cart->total_envio);

        // $response = $paypal->execute($request->paymentId,$request->PayerID);

        // if($response->state == "approved"){
        // // if("approved" == "approved"){

        //   \Session::remove('shopping_cart_id');

        //   $order = Order::createFromPayPalResponse($response,$shopping_cart);
        //   // $order = Order::first();
        //   $shopping_cart = $order->shoppingcart;
        //   // dd($shopping_cart);
          

        //   $shopping_cart->approve();

        //   $order->sendMail();

        // }









        return view("shopping_carts.completed", ["shopping_cart" => $shopping_cart, "order" =>  $order]);



    }



}

