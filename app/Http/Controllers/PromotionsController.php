<?php 
namespace App\Http\Controllers;





use App\Category;

use App\Product;

use App\InShoppingCart;

use App\Services\FavoriteProduct;

use Illuminate\Http\Request;
 
use Illuminate\Support\Collection;

class PromotionsController extends Controller {





    public function index(Request $request, FavoriteProduct $favoriteProduct)

    {

        $products = new Product();
        // $products = Product::all();



        $filters = $request->all();



        $category_selected = '';



        $old_inputs = [

            'title'            => '',

            'max_price'        => '',

            'order_created_at' => ''

        ];



        #filtrar productos por categoria, precio, titulo y recien agregados



        if (isset($filters['max_price']) && $filters['max_price'] != '' && is_numeric($filters['max_price']) && $filters['max_price'] > 0) {

            $products = $products->where('promotion_pricing', '<=', $filters['max_price']);

            $old_inputs['max_price'] = $filters['max_price'];

        }



        if (isset($filters['title']) && $filters['title'] != '') {

            $products = $products->Search($request->title);

            $old_inputs['title'] = $filters['title'];

        }



        if (isset($filters['order_created_at']) && $filters['order_created_at'] != '') {

            if ($filters['order_created_at'] == 'asc') {

                $products = $products->orderBy('created_at', 'asc');

                $old_inputs['order_created_at'] = 'asc';

            } else if ($filters['order_created_at'] == 'desc') {

                $products = $products->orderBy('created_at', 'desc');

                $old_inputs['order_created_at'] = 'desc';

            }

        }



        $promotions_category = Category::where('slug', 'Promociones')->first();


        
        $products = $products->where('category_id', $promotions_category->id)->orderBy('title','desc')->Paginate(9)->appends($filters);


        $pluck=$products->pluck('id');

        $inCarts=InShoppingCart::orderBy('qty','DESC')->get();

        $inter = array();


        foreach ($products as $product) {
            
            $product_total=0;

            foreach ($inCarts as $cart) {
                
                if($product->id==$cart->product_id){

                    $product_total+=$cart->qty;


                }
            }
             
            array_push($inter,array($product->id,$product_total));
        }

      

        //$inter=$inter->orderBy($inter[1]);
       


    
       

        return view('promotions.static', compact('products', 'category_selected', 'categories', 'favoriteProduct','inter'))->with($old_inputs);

    }



    public function visita(Request $request, FavoriteProduct $favoriteProduct)

    {

        $products = new Product();
       

                

        $filters = $request->all();

       
        


        $category_selected = '';



        $old_inputs = [

            'title'            => '',

            'max_price'        => '',

            'order_created_at' => ''

        ];

     

        #filtrar productos por categoria, precio, titulo y recien agregados



        if (isset($filters['max_price']) && $filters['max_price'] != '' && is_numeric($filters['max_price']) && $filters['max_price'] > 0) {

        

            $products = $products->where('promotion_pricing', '<', $filters['max_price']+1);

            $old_inputs['max_price'] = $filters['max_price'];

        }



        if (isset($filters['title']) && $filters['title'] != '') {

            
            $products = $products->Search($request->title);

            $old_inputs['title'] = $filters['title'];

        }



        if (isset($filters['order_created_at']) && $filters['order_created_at'] != '') {

            if ($filters['order_created_at'] == 'asc') {

                $products = $products->orderBy('created_at', 'asc');

                $old_inputs['order_created_at'] = 'asc';

            } else if ($filters['order_created_at'] == 'desc') {

                $products = $products->orderBy('created_at', 'desc');

                $old_inputs['order_created_at'] = 'desc';

            }

        }



        $promotions_category = Category::where('slug', 'Promociones')->first();


       
        $products = $products->where('category_id', $promotions_category->id)->orderBy('title','desc')->Paginate(9)->appends($filters);

       
        

        return view('promotions.visita', compact('products', 'category_selected', 'categories', 'favoriteProduct'))->with($old_inputs);

    }

}