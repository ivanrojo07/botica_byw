<?php



namespace App\Http\Controllers;





use Illuminate\Http\Request;

use App\ShoppingCart;

use App\InShoppingCart;



class InShoppingCartsController extends Controller {



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function index()

    {

        //

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        //

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $shopping_cart_id = \Session::get('shopping_cart_id');

        $shopping_cart = ShoppingCart::findOrCreateBySessionID($shopping_cart_id);





        $qty = 1;



        if ($request->has('qty') && is_numeric($request->input('qty')) && $request->input('qty') > 0) {

            $qty = $request->input('qty');

        }



        $product_in_cart = InShoppingCart::where('product_id', $request->product_id)

            ->where('shopping_cart_id', $shopping_cart_id)

            ->first();



        

        if ($product_in_cart) {

            $response = $product_in_cart->update([

                'qty' => $product_in_cart->qty + $qty

            ]);

        } else {

            $response = InShoppingCart::create(

                [

                    "shopping_cart_id" => $shopping_cart->id,

                    "product_id"       => $request->product_id,

                    "qty"              => $qty

                ]

            );

        }





        if ($response) {

            // return redirect('/carrito');
            return redirect()->back()->with([

                    'feedback'   => '¡Producto agregado a tu carrito de compra!',

                    'alert_type' => 'alert-success'

                ]);

        } else {

            return back();

        }

    }



    /**

     * Display the specified resource.

     *

     * @param  int $id

     * @return \Illuminate\Http\Response

     */

    public function show($id)

    {

        //

    }



    /**

     * Show the form for editing the specified resource.

     *

     * @param  int $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {

        //

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

        //

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        //

    }

}

