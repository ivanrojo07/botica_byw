<?php



namespace App\Http\Controllers;





use App\CambioMoneda;
use App\Catalogo;
use App\Category;
use App\Http\Requests;
use App\Product;
use App\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\only;





class MainController extends Controller {



    public function home()

    {
        $cambio = CambioMoneda::first()->get()->pluck('pesos');
        $products = Catalogo::inRandomOrder()->take(8)->get();




        #aplica metodo inrandomOrder que es de laravel lo cual primero ordena en orden aleatorio los productos y luego nada más tomamos

        #10 productos.

        // $products_slider = Product::where('category_id', 41)->inRandomOrder()->take(10)->get();
        $products_slider = Promotion::inRandomOrder()->take(10)->get();
        $products_slider1 = Promotion::inRandomOrder()->take(10)->get();
        // dd($products_slider);





        #obtenemos todas las categorias

        // $categories = Category::take(6)->get();
        $categories = Category::take(9)->get();



        return view('Main.home', compact('categories', 'products', 'products_slider', 'products_slider1','cambio'));



    }
    public function productlist(Request $request){
        $query = $request->input('products');
        $wordsquery = explode(' ',$query);

        $products = Catalogo::where(function($q) use($wordsquery){
            foreach ($wordsquery as $word) {
                # code...
                $q->orWhere('descripcion','LIKE',"%$word%")->orwhere('sustancia_activa','LIKE',"%$word%");
            }
        })->take(5)->get();
        return response()->json($products);
    }

    

}





