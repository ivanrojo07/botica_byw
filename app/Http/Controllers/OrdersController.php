<?php



namespace App\Http\Controllers;





use App\Direccion;
use App\InShoppingCart;
use App\Order;
use App\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



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
        $totalMonth = Order::total();
        

        $totalMonthCount = Order::totalCount();



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

                $address = Direccion::withTrashed()->find($address_id);



                if ($address) {

                    $type_address = 'normal';



                    return view('orders.addressinfo', compact('type_address', 'address'));

                }



                return 'No se encontró la dirección de envío';

            }

        }



        return 'No se encontró la dirección de envío';

    }

    public function shoppingInfo($shoppingcart){
        $shopping_cart = ShoppingCart::where('id', $shoppingcart)->first();
        if ($shopping_cart) {
            # code...
            $productos = $shopping_cart->products;
            $promotions = $shopping_cart->promotions;
            return view('orders.shopping_info', compact('productos','promotions','shopping_cart'));
        }
        else{
            return 'No se encontró esta compra: favor de hablar con el comprador';
        }
    }

    public function getOrden(Request $request){
        $num_orden = $request->input('orden');
        $orden = Order::find($num_orden);
        $direccion = $orden->shoppingCart->shoping_direccion;
        return response($direccion);
    }


    public function generarOrden(Request $request){
        
        $arrayArch = array();

        $dir = Storage::disk('local')->files();
        // dd($dir);
        foreach ($dir as $key => $value) {
            # code...
            if (strpos($value, '.DAT')) {
                # code...
                array_push($arrayArch, $value);
            }
        }
        // dd(count($arrayArch));
        if (count($arrayArch) == 1000){


        }
        else{

            $contador = count($arrayArch);

        }
        $orden = Order::find($request->input('orden'));
       
        $products = $orden->shoppingcart->products;
        $promotions = $orden->shoppingcart->promotions;
        $contenido = "";
        foreach ($products as $key => $product) {
            # code...
            $codigo = str_pad($product->codigo_de_barras, 13,'0',STR_PAD_LEFT);
            $cantidad = str_pad($product->pivot->qty, 3,'0',STR_PAD_LEFT);
            $contenido .= "0173800"."$codigo"."$cantidad"."000000000000000000000000000000000000000000000000\n";
            // $contenido .= "00000000000000000000000000000000000000000000000000000000000000000000000000000\n";

        }
        foreach ($promotions as $key => $promotion) {
            # code...
            $codigo = str_pad($promotion->codigo_barras, 13,'0',STR_PAD_LEFT);
            $cantidad = str_pad($promotion->pivot->qty, 3,'0',STR_PAD_LEFT);
            $contenido .= "0173800"."$codigo"."$cantidad"."000000000000000000000000000000000000000000000000\n";
            // $contenido .= "00000000000000000000000000000000000000000000000000000000000000000000000000000\n";
        }
        if ($orden->pedido_file) {
            # code...
            // dd('ya se creo pedido a la orden');
            return redirect()->back()->with(

                [

                    'feedback'   => 'Pedido realizado correctamente!',

                    'alert_type' => 'alert-success'

                ]

            );
        }
        else{

            $orden->pedido_file = 'FF7380'.str_pad($contador, 4,'0',STR_PAD_LEFT).'.DAT';
            $orden->status = "orden de compra";
            $orden->pedido_at =  \Carbon\Carbon::now('America/Mexico_City');
            $orden->save();
            

            $archivo = Storage::disk('local')->put('FF7380'.str_pad($contador, 4,'0',STR_PAD_LEFT).'.DAT', $contenido);
            Storage::disk('ftp')->put('/in/FF7380'.str_pad($contador, 4,'0',STR_PAD_LEFT).'.DAT', $contenido);
            return redirect()->back()->with(

                [

                    'feedback'   => 'Pedido realizado correctamente!',

                    'alert_type' => 'alert-success'

                ]

            );
            
        }




    }

    public function reenviarOrden(Request $request){
        $orden_id= $request->input('orden');
        $orden = Order::find($orden_id);
        $filepath = $orden->pedido_file;
        // dd($filepath);
        $archivo = Storage::disk('local')->get($filepath);
        Storage::disk('ftp')->put('/in/'.$filepath, $archivo);
        // dd($archivo);
        return redirect()->back()->with(

                [

                    'feedback'   => 'Pedido reenviado correctamente!',

                    'alert_type' => 'alert-success'

                ]

            );
    }


    public function pedidos(){
        $ordenes = Order::where("status", "orden de compra")->get();

        return view('orders.marzam',['ordenes' => $ordenes]);

        // dd($ordenes);
    }

    public function verificado(Request $request){
        // dd($request->all());
        $verificar = $request->input('verificar');

        if ($verificar) {
            # code...
            $orden = Order::find($verificar);
            $orden->verificado = 1;
            $orden->orden_compra_at =  \Carbon\Carbon::now('America/Mexico_City');
            $orden->save();
            return redirect()->back()->with(

                [

                    'feedback'   => 'Pedido verificado correctamente!',

                    'alert_type' => 'alert-success'

                ]

            );
        }
    }

    public function empaquetadoIndex(){
        $ordenes = Order::where('verificado', 1)->where(function ($query){
            $query->where('status','orden de compra')->orWhere('status','empaquetado')->orWhere('status','en tramite');
        })->get();
        // $ordenes = Order::where('status','orden de compra')->orWhere('status','empaquetado')->where('verificado', 1)->get();
        return view('orders.empaquetado',['ordenes'=>$ordenes]);
    }

    public function checkingProduct($shoppingcart){
        $shopping_cart = ShoppingCart::where('id', $shoppingcart)->first();
        if ($shopping_cart) {
            # code...
            $productos = $shopping_cart->products;
            $promotions = $shopping_cart->promotions;

            return view('orders.productscheck', compact('productos','promotions','shopping_cart'));
        }
        else{
            return 'No se encontró esta compra: favor de hablar con el comprador';
        }
    }

    public function productoCheck(Request $request){

        $inshopId = $request->input('checked');
        $producto = InShoppingCart::find($inshopId);
        if ($producto->empaquetado == 0) {
            # code...
            $producto->empaquetado = 1;
            $producto->save();
            return "true";
        } else {
            # code...
            $producto->empaquetado = 0;
            $producto->save();
            return "false";
        }
        
    }
    public function promotionCheck(Request $request){

        // dd($request->all());

        $inshopId = $request->input('checked');
        $producto = InShoppingCart::find($inshopId);
        if ($producto->empaquetado == 0) {
            # code...
            $producto->empaquetado = 1;
            $producto->save();
            return "true";
        } else {
            # code...
            $producto->empaquetado = 0;
            $producto->save();
            return "false";
        }
        
    }


    public function empaquetarCompra(Request $request){
        // dd($request->all());
        $orden_id = $request->input('verificar');

        $orden = Order::findOrFail($orden_id);
        // dd($orden);
        $productos = $orden->shoppingcart->products;
        $promotions = $orden->shoppingcart->promotions;
        foreach ($productos as $key => $value) {
            # code...
            if ($value->pivot->empaquetado == 1) {
                # code...
                $verificado = true;
                
            }
            else{
                $verificado = false;
                return redirect()->back()->with(

                [

                    'feedback'   => 'No puedes empaquetar este pedido, verifica que todos los productos esten recibidos en el boton productos.',

                    'alert_type' => 'alert-danger'

                ]);
            }
            // dd($value->pivot);
        }
        foreach ($promotions as $key => $value) {
            # code...
            if ($value->pivot->empaquetado == 1) {
                # code...
                $verificado = true;
                
            }
            else{
                $verificado = false;
                return redirect()->back()->with(

                [

                    'feedback'   => 'No puedes empaquetar este pedido, verifica que todos los productos esten recibidos en el boton productos.',

                    'alert_type' => 'alert-danger'

                ]);
            }
            // dd($value->pivot);
        }
        if ($verificado == true) {
            # code...
            $orden->empaquetado_at = \Carbon\Carbon::now('America/Mexico_City');
            $orden->status = "empaquetado";
            $orden->save();
            return redirect()->back()->with(

                [

                    'feedback'   => "Paquete empaquetado a las $orden->empaquetado_at",

                    'alert_type' => 'alert-success'

                ]);

        }
    }


    public function createTracking($orden_id){
        // dd($orden_id);
        $orden = Order::findOrFail($orden_id);
        $direccion_id = $orden->direccion_id;
        $shopping_cart = $orden->ShoppingCart;
        $direccion = Direccion::withTrashed()->findOrFail($direccion_id);
        // dd($direccion);


        return view('orders.tracking',['orden'=>$orden,'shopping_cart'=>$shopping_cart,'direccion'=>$direccion]);
    }


}

