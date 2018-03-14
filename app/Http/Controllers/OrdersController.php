<?php



namespace App\Http\Controllers;





use App\Direccion;

use App\ShoppingCart;

use Illuminate\Http\Request;

use App\Order;



class OrdersController extends Controller {



    public function __construct()

    {

        $this->middleware("auth");

    }





    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        $orders = Order::latest()->get();

        $totalMonth = Order::totalMonth();

        $totalMonthCount = Order::totalMonthCount();



        return view('orders.index', ['orders' => $orders, "totalMonth" => $totalMonth, "totalMonthCount" => $totalMonthCount]);





    }





    /**

     * Update the specified resource in storage.

     *

     * @param  \Illuminate\Http\Request $request

     * @param  int $id

     * @return \Illuminate\Http\Response

     */

    public function update(Request $request, $id)

    {

        $order = Order::find($id);



        $field = $request->name;



        $order->$field = $request->value;



        $order->save();



        return $order->$field;

    }





    /*

     * get address data

     */

    public function getAddressInfo($shoppingcart)

    {

        $shopping_cart = ShoppingCart::where('id', $shoppingcart)->first();



        if ($shopping_cart) {

            $address_id = $shopping_cart->direccion_id;

            if (is_null($address_id)) {

                #obtenemos la direccion de order de paypal

                $type_address = 'paypal';

                $address = Order::where('shopping_cart_id', $shoppingcart)->first();



                return view('orders.addressinfo', compact('type_address', 'address'));

            } else {

                #obtenemos la direccion

                $address = Direccion::find($address_id);



                if ($address) {

                    $type_address = 'normal';



                    return view('orders.addressinfo', compact('type_address', 'address'));

                }



                return 'No se encontró la dirección de envío';

            }

        }



        return 'No se encontró la dirección de envío';

    }

    public function getOrden(Request $request){
        $num_orden = $request->input('orden');
        $orden = Order::find($num_orden);
        $direccion = $orden->shoppingCart->shoping_direccion;
        return response($direccion);
    }



}

