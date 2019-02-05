<?php



namespace App\Http\Controllers;



use App\CambioMoneda;
use App\Country;
use App\Contacto;
use App\Direccion;
use App\Events\PedidoCreated;
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
    public function wish(ShoppingCart $shopping_cart){

        // dd( $shopping_cart);
        // dd($tracking);
        if(Auth::user()->id == $shopping_cart->user_id){
            return view("shopping_carts.status", ["shopping_cart" => $shopping_cart]);
        }
        else{
            return redirect()->route('users.pedidos');
        }
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
        $promotions = $shopping_cart->promotions()->get();
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
        foreach ($promotions as $product) {
            # code...
            $peso += 0.10*$product->pivot->qty;
        }
        
        $envio = ZonaEnvio::where('peso', '>=', "$peso")->first();
        if (is_null($envio)) {
            # code...
            $envio = ZonaEnvio::get()->last();

        }
        // dd($envio);



        // $total = $shopping_cart->total();
        $total = number_format($shopping_cart->total(), 2);
        // dd($direcctions);


        $countries = Country::orderBy('name','asc')->get();
        return view("shopping_carts.index", compact('products','promotions', 'total', 'direccion_default','direcctions','envio','countries'));



    }



    public function checkout(Request $request)

    {
        // dd($request->all());
        // $orden = Order::find(4);
        // dd($orden->sendMail());

        $cambio = CambioMoneda::first()->get()->pluck('pesos');


        $messages = [

            'receta_file.required'       => 'El archivo de la receta es obligatorio.',

            'receta_file.file'           => 'El archivo de la receta debe ser un archivo valido.',

            'receta_file.mimes'          => 'El archivo de la receta debe tener alguna de las extenciones (jpeg, jpg, jpe, png o pdf).',

            // 'direccion_default.required' => 'La dirección de envío es requerida, por favor ingresa a tus direcciones para colocar tu direccion de envio',


        ];



        $validations = [

            'receta_file' => 'required|file|mimes:jpeg,jpg,jpe,png,pdf'

        ];



        if (Auth::check()) {

            // $validations['direccion_default'] = 'required';

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

            // $direccion_id = $request->input('direccion_default');

        }
        else{

            $user_id = null;

            // $direccion_id = $request->input('direccion_default');

        }

        // $direccion = Direccion::find($direccion_id);
        // // $totalstr = $shopping_cart->total();
        // // $total = number_format((float)$totalstr, 2, '.', '');
        // // dd($total);
        // $products = $shopping_cart->products()->get();
        // $peso = 0.00;

        // foreach ($products as $product) {
        //     # code...
        //     if ($product->tipo_de_producto == "ET" ) {
        //         # code...
        //         $peso += 0.01*$product->pivot->qty;

        //     }
        //     if ($product->tipo_de_producto == "MC") {
        //          # code...
        //         $peso += 0.10*$product->pivot->qty;
        //      } 
        //     if ($product->tipo_de_producto == "VA") {
        //         # code...
        //         $peso += 10.00*$product->pivot->qty;
        //     }
        //     if ($product->tipo_de_producto == "PF") {
        //         # code...
        //         $peso += 1.00*$product->pivot->qty;
        //     }
        //     if($product->tipo_de_producto == "OT"){
        //         $peso += 0.01*$product->pivot->qty; 
        //     }
        // }
        // $envio = ZonaEnvio::where('peso', '>=', "$peso")->first();
        // if (is_null($envio)) {
        //     # code...
        //     $envio = ZonaEnvio::get()->last();

        // }
        
        // // $cambio = CambioMoneda::first()->get()->pluck('pesos');
        // // dd($request->all());
        // if ($direccion->pais == "USA" || $direccion->pais == "usa" || $direccion->pais == "Estados Unidos de América" || $direccion->pais == 'Estados Unidos' || $direccion->pais == 'estados unidos' || $direccion->pais == "Estados Unidos de America" || $direccion->pais == "estados unidos de america" || $direccion->pais == "EE UU"|| $direccion->pais == "ee uu"|| $direccion->pais == "eu") {
        //     # code...
        //     if ($direccion->estado == "Florida" || $direccion->estado == "florida" ||$direccion->estado == "FL" || $direccion->estado == "fl") {
        //         # code...
        //         if ($direccion->ciudad == 'miami'|| $direccion->ciudad == 'Miami') {
        //             # code...
        //             $precio_envio = number_format((($envio->precio_a+($envio->precio_a*(0.40)))),2);
        //             // dd('precio a');
        //         }
                
        //     }
            
        // }
       
        // elseif (mb_strtolower($direccion->pais) == "costa rica" || mb_strtolower($direccion->pais) == "el salvador" || mb_strtolower($direccion->pais) == "guatemala" || mb_strtolower($direccion->pais) == "honduras" || mb_strtolower($direccion->pais) == "nicaragua" || mb_strtolower($direccion->pais) == "panama" ) {
        //     # code...
        //     $precio_envio = number_format((($envio->precio_b+($envio->precio_b*(0.40)))),2);
        //     // dd('precio b');
        //     }
        // elseif (mb_strtolower($direccion->pais) == "colombia" || mb_strtolower($direccion->pais) == "r. dominicana") {
        //     # code...
        //     $precio_envio = number_format((($envio->precio_c+($envio->precio_c*(0.40)))),2);;
        //     // dd('precio c');
        //     }

        // elseif ( mb_strtolower($direccion->pais) == "argentina" || mb_strtolower($direccion->pais) == "bolivia"  || mb_strtolower($direccion->pais) == "chile" || mb_strtolower($direccion->pais) == "ecuador" || mb_strtolower($direccion->pais) == "mexico" || mb_strtolower($direccion->pais) == "paraguay" || mb_strtolower($direccion->pais) == "peru" || mb_strtolower($direccion->pais) == "trinidad y tobago" || mb_strtolower($direccion->pais) == "uruguay"|| mb_strtolower($direccion->pais) == "venezuela") {
        //         # code...
        //         $precio_envio = number_format((($envio->precio_d+($envio->precio_d*(0.40)))),2);
        //         // dd('precio d');
        //     }

        // elseif (mb_strtolower($direccion->pais) == "aruba" || mb_strtolower($direccion->pais) == "brasil" || mb_strtolower($direccion->pais) == "coracao" || mb_strtolower($direccion->pais) == "haiti" || mb_strtolower($direccion->pais) == "jamaica" || mb_strtolower($direccion->pais) == "sint maarten") {
        //         # code...
        //         $precio_envio = number_format((($envio->precio_e+($envio->precio_e*(0.40)))),2);
        //         // dd('precio e');
        //     }
        // elseif (mb_strtolower($direccion->pais) == "anguila" || mb_strtolower($direccion->pais) == "antigua y barbuda" || mb_strtolower($direccion->pais) == "antillas holandesas" || mb_strtolower($direccion->pais) == "bahamas" || mb_strtolower($direccion->pais) == "barbados" || mb_strtolower($direccion->pais) == "belice" || mb_strtolower($direccion->pais) == "bermudas" || mb_strtolower($direccion->pais) == "bonaire" || mb_strtolower($direccion->pais) == "canada" || mb_strtolower($direccion->pais) == "cuba" || mb_strtolower($direccion->pais) == "dominica" || mb_strtolower($direccion->pais) == "granada" || mb_strtolower($direccion->pais) == "guadalupe" || mb_strtolower($direccion->pais) == "islas caiman" || mb_strtolower($direccion->pais) == "islas marianas" || mb_strtolower($direccion->pais) == "islas minor" || mb_strtolower($direccion->pais) == "islas virg britanicas" || mb_strtolower($direccion->pais) == "islas virginias am" || mb_strtolower($direccion->pais) == "martinica" || mb_strtolower($direccion->pais) == "montserrat" || mb_strtolower($direccion->pais) == "puerto rico" || mb_strtolower($direccion->pais) == "road town arpt" || mb_strtolower($direccion->pais) == "roosevelt field" || mb_strtolower($direccion->pais) == "santa lucia" || mb_strtolower($direccion->pais) == "st jean arpt" || mb_strtolower($direccion->pais) == "st thomas" || mb_strtolower($direccion->pais) == "st bartolome" || mb_strtolower($direccion->pais) == "st kitts" || mb_strtolower($direccion->pais) == "st vincent" || mb_strtolower($direccion->pais) == "turcas y caicos" || mb_strtolower($direccion->pais) == "wallis fortuna") {
        //     # code...
        //     $precio_envio = number_format((($envio->precio_f+($envio->precio_f*(0.40)))),2);

        // }
        // elseif (mb_strtolower($direccion->pais) == "alemania" || mb_strtolower($direccion->pais) == "andorra" || mb_strtolower($direccion->pais) == "armenia" || mb_strtolower($direccion->pais) == "austria" || mb_strtolower($direccion->pais) == "azerbayan" || mb_strtolower($direccion->pais) == "banja luka arpt" || mb_strtolower($direccion->pais) == "" || mb_strtolower($direccion->pais) == "belgica" || mb_strtolower($direccion->pais) == "bielorrusia" || mb_strtolower($direccion->pais) == "bosnia herzegovina" || mb_strtolower($direccion->pais) == "bulgaria" || mb_strtolower($direccion->pais) == "c. vaticano" || mb_strtolower($direccion->pais) == "croacia" || mb_strtolower($direccion->pais) == "dinamarca" || mb_strtolower($direccion->pais) == "eslovaquia" || mb_strtolower($direccion->pais) == "eslovenia" || mb_strtolower($direccion->pais) == "españa" || mb_strtolower($direccion->pais) == "estonia" || mb_strtolower($direccion->pais) == "finlandia" || mb_strtolower($direccion->pais) == "francia" || mb_strtolower($direccion->pais) == "georgia" || mb_strtolower($direccion->pais) == "gibraltar" || mb_strtolower($direccion->pais) == "grecia" || mb_strtolower($direccion->pais) == "heathrow" || mb_strtolower($direccion->pais) == "holanda" || mb_strtolower($direccion->pais) == "hungria" || mb_strtolower($direccion->pais) == "irlanda" || mb_strtolower($direccion->pais) == "islandia" || mb_strtolower($direccion->pais) == "islas faroe" || mb_strtolower($direccion->pais) == "italia" || mb_strtolower($direccion->pais) == "kazajstan" || mb_strtolower($direccion->pais) == "kyrgyzstan" || mb_strtolower($direccion->pais) == "letonia" || mb_strtolower($direccion->pais) == "lienchestein" || mb_strtolower($direccion->pais) == "lituania" || mb_strtolower($direccion->pais) == "reino unido" || mb_strtolower($direccion->pais) == "luxemburgo" || mb_strtolower($direccion->pais) == "malta" || mb_strtolower($direccion->pais) == "moldavia" || mb_strtolower($direccion->pais) == "montenegro" || mb_strtolower($direccion->pais) == "north front arpt" || mb_strtolower($direccion->pais) == "noruega" || mb_strtolower($direccion->pais) == "polonia" || mb_strtolower($direccion->pais) == "portugal" || mb_strtolower($direccion->pais) == "monaco" || mb_strtolower($direccion->pais) == "inglaterra" || mb_strtolower($direccion->pais) == "republica checa" || mb_strtolower($direccion->pais) == "rumania" || mb_strtolower($direccion->pais) == "san marino" || mb_strtolower($direccion->pais) == "serbia" || mb_strtolower($direccion->pais) == "serbia montenegro" || mb_strtolower($direccion->pais) == "suecia" || mb_strtolower($direccion->pais) == "suiza" || mb_strtolower($direccion->pais) == "tayikistan" || mb_strtolower($direccion->pais) == "ucrania" || mb_strtolower($direccion->pais) == "uzbekistan") {
        //     # code...
        //     $precio_envio = number_format((($envio->precio_g+($envio->precio_g*(0.40)))),2);
        // }
        // elseif (mb_strtolower($direccion->pais) == "australia" || mb_strtolower($direccion->pais) == "bangladesh" || mb_strtolower($direccion->pais) == "bhutan" || mb_strtolower($direccion->pais) == "birmania" || mb_strtolower($direccion->pais) == "brunei" || mb_strtolower($direccion->pais) == "camboya" || mb_strtolower($direccion->pais) == "china" || mb_strtolower($direccion->pais) == "corea del norte" || mb_strtolower($direccion->pais) == "corea del sur" || mb_strtolower($direccion->pais) == "filipinas" || mb_strtolower($direccion->pais) == "guam" || mb_strtolower($direccion->pais) == "guayana" || mb_strtolower($direccion->pais) == "guayana francesa" || mb_strtolower($direccion->pais) == "guinea ecuatorial" || mb_strtolower($direccion->pais) == "hong kong" || mb_strtolower($direccion->pais) == "indonesia" || mb_strtolower($direccion->pais) == "isa nauru" || mb_strtolower($direccion->pais) == "islas cook" || mb_strtolower($direccion->pais) == "islas salomon" || mb_strtolower($direccion->pais) == "japon" || mb_strtolower($direccion->pais) == "kiribati" || mb_strtolower($direccion->pais) == "laos" || mb_strtolower($direccion->pais) == "macao" || mb_strtolower($direccion->pais) == "malasia" || mb_strtolower($direccion->pais) == "maldivas" || mb_strtolower($direccion->pais) == "myanmar" || mb_strtolower($direccion->pais) == "nepal" || mb_strtolower($direccion->pais) == "nueva caledonia" || mb_strtolower($direccion->pais) == "nueva zelanda" || mb_strtolower($direccion->pais) == "papua nueva guinea" || mb_strtolower($direccion->pais) == "singapur" || mb_strtolower($direccion->pais) == "sri lanka" || mb_strtolower($direccion->pais) == "vanuatu" || mb_strtolower($direccion->pais) == "taiwan" || mb_strtolower($direccion->pais) == "thailandia" || mb_strtolower($direccion->pais) == "vietnam") {
        //     # code...
        //     $precio_envio = number_format((($envio->precio_h+($envio->precio_h*(0.40)))),2);
        // }
        // else{
        //     $precio_envio = "tu dirección esta erronea o tu compra no puede ser enviada a"+$direccion->pais;
        // }

        // dd($envio);

        $shopping_cart->update([

            'user_id'      => $user_id,

            // 'direccion_id' => $direccion_id,

            'total'        => $shopping_cart->total(),
            // 'totalenvio' => $precio_envio,
            // 'total'        => $shopping_cart->total()+$precio_envio,
            // 'totalenvio' => $precio_envio,
            'status'       => 'create',
            'receta_path'  => $path

        ]);
        $contacto = new Contacto($request->all());
        $shopping_cart->contacto()->save($contacto);

        // dd($shopping_cart);
         \Session::remove('shopping_cart_id');

        // Pruebas
         event(new PedidoCreated($shopping_cart));
        return redirect()->route('shopping_carts.wish_complete',['shopping_cart'=>$shopping_cart]);
        // return view('shopping_carts.send_order');

        // return redirect('payments/store');


// PAYPAL
        // $paypal = new PayPal($shopping_cart,$precio_envio);



        // $payment = $paypal->generate();



        // return redirect($payment->getApprovalLink());

    }
    public function complete(ShoppingCart $shopping_cart)
    {
        if(Auth::user() && Auth::user()->id == $shopping_cart->user_id){
            // event(new PedidoCreated($shopping_cart));
            return view("shopping_carts.send_order", ["shopping_cart" => $shopping_cart]);
        }
        else{
            return redirect('/carrito');
        }
    }



    public function destroy($id)

    {

        $shopping_cart_id = \Session::get('shopping_cart_id');

        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);



        InShoppingCart::where('catalogo_id', $id)->where('shopping_cart_id', $shopping_cart->id)->delete();



        return redirect('/carrito');

    }

    public function destroypromo ($id)
    {
        $shopping_cart_id = \Session::get('shopping_cart_id');

        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);



        InShoppingCart::where('promotion_id', $id)->where('shopping_cart_id', $shopping_cart->id)->delete();



        return redirect('/carrito');
    }




}

