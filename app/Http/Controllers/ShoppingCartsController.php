<?php



namespace App\Http\Controllers;



use App\Direccion;
use App\Http\Controllers\InShoppingCartsController;
use App\InShoppingCart;
use App\Mail\OrderCreated;
use App\Order;
use App\Paypal;
use App\ShoppingCart;
use App\ZonaEnvio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;



class ShoppingCartsController extends Controller {



    public function show($id)

    {

        $shopping_cart = ShoppingCart::where('customid', $id)->first();
        $order = $shopping_cart->order;
        // dd($order);
        $tracking = $order->tracking;

        // dd($tracking);

        return view("shopping_carts.completed", ["shopping_cart" => $shopping_cart, "order" => $order, 'tracking'=>$tracking]);

    }
    public function pedido($id){

        $shopping_cart = ShoppingCart::where('customid', $id)->first();

        $order = $shopping_cart->order;
        
        $trackings = $order->trackings;
        // dd($tracking);

        return view("shopping_carts.status", ["shopping_cart" => $shopping_cart, "order" => $order, 'trackings'=>$trackings]);
    }
    public function buscar(Request $request)
    {
        # code...
        $shopping_cart_id = $request->tracking;
        $shopping_cart = ShoppingCart::where('customid',$shopping_cart_id)->first();
        if ($shopping_cart != null) {
            # code...
            $order = $shopping_cart->order;
            $trackings = $order->trackings;
            // dd($trackings->count());
            return view("static.seguimiento", ["shopping_cart" =>$shopping_cart, "order"=>$order, "trackings"=>$trackings]);
        }
        else {

            $order = null;
            $trackings = null;
            return view("static.seguimiento", ["shopping_cart" =>$shopping_cart, "order"=>$order, "trackings"=>$trackings]);

        }
    }


    public function index()

    {
        
        $shopping_cart_id = \Session::get('shopping_cart_id');



        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);

        // dd($shopping_cart);

        $direccion_default = '';
        $direcctions = '';



        if (Auth::check()) {

            $direcctions = Direccion::where('id_user', Auth::user()->id)->get();
            if ($direcctions->isEmpty() == true) {
                # code...
                $direcctions = "";
            }
            // dd($direcctions);

            // $direccion_default = Direccion::where('id_user', Auth::user()->id)

            //     ->where('default', 1)->first();

        }
        else{
            if(Session('direccion_default') == null){
                $direccion_default = '';
            }
            else{
                $direccion_default = Session('direccion_default');
            }

        }




        $products = $shopping_cart->products()->get();
        $peso = 0.00;

        foreach ($products as $product) {
            # code...
            if ($product->tipo_de_producto == "ET" ) {
                # code...
                $peso += 0.01*$product->pivot->qty;

            }
            if ($product->tipo_de_producto == "MC") {
                 # code...
                $peso += 0.10*$product->pivot->qty;
             } 
            if ($product->tipo_de_producto == "VA") {
                # code...
                $peso += 10.00*$product->pivot->qty;
            }
            if ($product->tipo_de_producto == "PF") {
                # code...
                $peso += 1.00*$product->pivot->qty;
            }
            if($product->tipo_de_producto == "OT"){
                $peso += 0.01*$product->pivot->qty; 
            }
        }
        
        $envio = ZonaEnvio::where('peso', '>=', "$peso")->first();
        // dd($envio);



        // $total = $shopping_cart->total();
        $total = number_format($shopping_cart->total(), 2);
        // dd($direcctions);



        return view("shopping_carts.index", compact('products', 'total', 'direccion_default','direcctions','envio'));



    }



    public function checkout(Request $request)

    {
        // dd($request->all());

        $messages = [

            'receta_file.required'       => 'El archivo de la receta es obligatorio.',

            'receta_file.file'           => 'El archivo de la receta debe ser un archivo valido.',

            'receta_file.mimes'          => 'El archivo de la receta debe tener alguna de las extenciones (jpeg, jpg, jpe, png o pdf).',

            'direccion_default.required' => 'La dirección de envío es requerida, por favor ingresa a tus direcciones para colocar tu direccion de envio',


        ];



        $validations = [

            'receta_file' => 'required|file|mimes:jpeg,jpg,jpe,png,pdf'

        ];



        if (Auth::check()) {

            $validations['direccion_default'] = 'required';

        }



        $this->validate($request, $validations, $messages);





        $shopping_cart_id = \Session::get('shopping_cart_id');

        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);







        #procedemos a subir el archivo de la receta y borramos el anterior si es que existia

        if ($shopping_cart->receta_path != '') {

            Storage::delete($shopping_cart->receta_path);

        }



        $path = $request->file('receta_file')->store('recetas');



        #si el usuario está logueado actualizamos user_id y direccion_id
        if (Auth::check()) {

            $user_id = Auth::user()->id;

            $direccion_id = $request->input('direccion_default');

        }
        else{

            $user_id = null;

            $direccion_id = $request->input('direccion_default');

        }

        $direccion = Direccion::find($direccion_id);
        // $totalstr = $shopping_cart->total();
        // $total = number_format((float)$totalstr, 2, '.', '');
        // dd($total);
        $products = $shopping_cart->products()->get();
        $peso = 0.00;

        foreach ($products as $product) {
            # code...
            if ($product->tipo_de_producto == "ET" ) {
                # code...
                $peso += 0.01*$product->pivot->qty;

            }
            if ($product->tipo_de_producto == "MC") {
                 # code...
                $peso += 0.10*$product->pivot->qty;
             } 
            if ($product->tipo_de_producto == "VA") {
                # code...
                $peso += 10.00*$product->pivot->qty;
            }
            if ($product->tipo_de_producto == "PF") {
                # code...
                $peso += 1.00*$product->pivot->qty;
            }
            if($product->tipo_de_producto == "OT"){
                $peso += 0.01*$product->pivot->qty; 
            }
        }
        $envio = ZonaEnvio::where('peso', '>=', "$peso")->first();
        dd($envio);

        $shopping_cart->update([

            'user_id'      => $user_id,

            'direccion_id' => $direccion_id,

            'total'        => $shopping_cart->total(),

            'receta_path'  => $path

        ]);





        $paypal = new PayPal($shopping_cart);



        $payment = $paypal->generate();



        return redirect($payment->getApprovalLink());

    }



    public function destroy($id)

    {

        $shopping_cart_id = \Session::get('shopping_cart_id');

        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);



        InShoppingCart::where('catalogo_id', $id)->where('shopping_cart_id', $shopping_cart->id)->delete();



        return redirect('/carrito');

    }


    

}

