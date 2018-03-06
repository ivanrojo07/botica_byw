<?php namespace App\Http\Controllers;





use App\Product;

use App\Services\FavoriteProduct;

use Illuminate\Support\Facades\Auth;



class FavoriteProductsController extends Controller {



    public function __construct()

    {

        $this->middleware('auth');

    }



    public function index(FavoriteProduct $favoriteProduct)

    {

        $products = Auth::user()->favorite_products()->simplePaginate(9);



        return view('user.favorite_products', compact('products', 'favoriteProduct'));

    }



    public function addremove($product_id)

    {



        $user = Auth::user();

        $result = $user->favorite_products()->where('catalogo_id', $product_id)->get();



        if (count($result)) {

            ##si hay lo borramos

            $user->favorite_products()->detach($product_id);

            $message = "Producto Eliminado de tus favoritos";

        } else {

            ##si no hay lo agregamos

            $user->favorite_products()->attach($product_id);

            $message = "Producto Agregado a tus favoritos";

        }



        return redirect()->back()->with([

            'favorite_status' => $message

        ]);





    }

}