<?php



namespace App\Http\Controllers;



use App\Order;

use App\Direccion;

use Illuminate\Http\Request;

use App\ShoppingCart;

use App\Paypal;



use App\InShoppingCart;

use App\Http\Controllers\InShoppingCartsController;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Mail;

use App\Mail\OrderCreated;



class ShoppingCartsController extends Controller {



    public function show($id)

    {

        $shopping_cart = ShoppingCart::where('customid', $id)->first();

        $order = $shopping_cart->order();



        return view("shopping_carts.completed", ["shopping_cart" => $shopping_cart, "order" => $order]);

    }



    public function index()

    {
        
        $shopping_cart_id = \Session::get('shopping_cart_id');



        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);



        // $direccion_default = '';



        if (Auth::check()) {

            $direccion_default = Direccion::where('id_user', Auth::user()->id)

                ->where('default', 1)->first();

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



        // $total = $shopping_cart->total();
        $total = number_format($shopping_cart->total(), 2);



        return view("shopping_carts.index", compact('products', 'total', 'direccion_default'));



    }



    public function checkout(Request $request)

    {

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
        // $totalstr = $shopping_cart->total();
        // $total = number_format((float)$totalstr, 2, '.', '');
        // dd($total);

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



        InShoppingCart::where('product_id', $id)->where('shopping_cart_id', $shopping_cart->id)->delete();



        return redirect('/carrito');

    }

}

