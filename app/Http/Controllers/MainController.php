<?php



namespace App\Http\Controllers;





use App\Category;
use App\Http\Requests;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\only;





class MainController extends Controller {



    public function home()

    {
        $products0 = Product::inRandomOrder()->take(4)->get();
        $products1 = Product::inrandomOrder()->take(4)->get();




        #aplica metodo inrandomOrder que es de laravel lo cual primero ordena en orden aleatorio los productos y luego nada más tomamos

        #10 productos.

        // $products_slider = Product::where('category_id', 41)->inRandomOrder()->take(10)->get();
        $products_slider = Product::inRandomOrder()->take(10)->get();
        // dd($products_slider);





        #obtenemos todas las categorias

        // $categories = Category::take(6)->get();
        $categories = Category::take(9)->get();



        return view('Main.home', compact('categories', 'products0', 'products1', 'products_slider'));



    }
    public function productlist(Request $request){
        $query = $request->input('products');
        $wordsquery = explode(' ',$query);

        $products = Product::where(function($q) use($wordsquery){
            foreach ($wordsquery as $word) {
                # code...
                $q->orWhere('title','LIKE',"%$word%");
            }
        })->take(5)->get();
        return response()->json($products);
    }

}





