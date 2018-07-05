<?php



namespace App\Http\Controllers;





use App\CambioMoneda;
use App\Catalogo;
use App\Category;
use App\Product;
use App\ProductComment;
use App\Services\FavoriteProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



class ProductsController extends Controller {



    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function __construct()

    {



    }



    public function index()

    {

        // $products = Product::orderBy('id')->Paginate(35);
        $products = Catalogo::orderBy('id')->Paginate(35);
        $cambio = CambioMoneda::first()->get()->pluck('pesos');



        return view("products.index", ["products" => $products, 'cambio'=>$cambio]);

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function create()

    {

        $product = new Product;



        $categories = Category::all(['id', 'title']);



        return view("products.create", compact('product', 'categories'));

    }



    /**

     * Store a newly created resource in storage.

     *

     * @param  \Illuminate\Http\Request $request

     * @return \Illuminate\Http\Response

     */

    public function store(Request $request)

    {

        $hasFile = $request->hasFile('cover') && $request->cover->isValid();



        $product = new Product;

        $product->title = $request->title;

        $product->category = '';

        $product->category_id = $request->category_id;

        $product->description = $request->description;



        $category = Category::where('id', $request->category_id)->first();



        if($category->slug == 'Promociones'){

            $product->pricing = '0.0';

            $product->promotion_pricing = $request->pricing;

        }else{

            $product->pricing = $request->pricing;

            $product->promotion_pricing = '0.0';

        }





        $product->user_id = Auth::user()->id;



        if ($hasFile) {

            $extension = $request->cover->extension();

            $product->extension = $extension;

        }



        if ($product->save()) {



            if ($hasFile) {

                $request->cover->storeAs('images', "$product->id.$extension");

            }



            return redirect("/products");

        } else {

            return view("products.create", ["product" => $product]);

        }

    }



    /**

     * Display the specified resource.

     *

     * @param  int $id

     * @return \Illuminate\Http\Response

     */



    public function show($id, FavoriteProduct $favoriteProduct)

    {

        $product = Catalogo::find($id);
        $cambio = CambioMoneda::first()->get()->pluck('pesos');




        #obtenemos las reseñas del producto

        $product_comments = ProductComment::where('catalogo_id', $id)->get();



        return view('products.show', compact('product', 'favoriteProduct', 'product_comments','cambio'));

    }



    public function statics(Request $request, FavoriteProduct $favoriteProduct)

    {


        $cambio = CambioMoneda::first()->get()->pluck('pesos');
        // dd($cambio[0]);

        $products = new Catalogo();



        $filters = $request->all();



        $category_selected = '';



        $categories = DB::select("select distinct tipo_de_producto from catalogo");

        // $categories = $categories->where('title','=!','OT');
        // dd($categories);
        // $value=array_count_values($categories);
        // $categories[0][1]->test = "test";
        foreach ($categories as $category) {
            # code...
            // $category->test = "test";
            // dd($category);

            if ($category->tipo_de_producto == "ET") {
                # code...
                $category->nombre = "Medicamentos de patente";
            }

            if ($category->tipo_de_producto == "VA") {
                # code...
                $category->nombre = "Varios";
            }

            if ($category->tipo_de_producto == "PF") {
                # code...
                $category->nombre = "Perfumería";
            }

            if ($category->tipo_de_producto == "MC") {
                # code...
                $category->nombre = "Material de Curación";
            }

            if ($category->tipo_de_producto == "OT") {
                # code...
                $category->nombre = "Medicamentos Generales";
            }

            if ($category->tipo_de_producto == "CO") {
                # code...
                $category->nombre = "Controlado";
            }
            Category::updateOrCreate(
                [
                    'title' => $category->tipo_de_producto
                ],
                [
                    'title' => $category->tipo_de_producto,
                    'slug' => $category->tipo_de_producto,
                    'description' =>$category->nombre,
                ]

            );
        }
        // dd($categories);



        $old_inputs = [

            'title'            => '',

            'max_price'        => '',

            'order_created_at' => ''

        ];



        #filtrar productos por categoria, precio, titulo y recien agregados



        if (isset($filters['category']) && $filters['category'] != '' && $filters['category'] != 'all') {



            $category_selected = $filters['category'];
            



            if ($category_selected) {

                
                $products = $products->where("tipo_de_producto", $category_selected);


            } 

            

            else {

                $products->all();
                // dd($products);

            }

        }



        if (isset($filters['max_price']) && $filters['max_price'] != '' && is_numeric($filters['max_price']) && $filters['max_price'] > 0) {

            $products = $products->where('precio_publico', '<=', $filters['max_price']);

            $old_inputs['max_price'] = $filters['max_price'];

        }


        if (isset($filters['title']) && $filters['title'] != '') {

            $products = $products->where('descripcion','LIKE',"%$request->title%")->orWhere('sustancia_activa','LIKE',"%$request->title%");

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



        $products = $products->orderBy('descripcion')->Paginate(9)->appends($filters);
        // dd($favoriteProduct);




        return view('products.static', compact('products', 'category_selected', 'categories', 'favoriteProduct','cambio'))->with($old_inputs);



    }





    /**

     * Show the form for editing the specified resource.

     *

     * @param  int $id

     * @return \Illuminate\Http\Response

     */

    public function edit($id)

    {



        $product = Catalogo::find($id);



        $categories = Category::all();

        // dd($product);

        return view("products.edit", ["product" => $product, "categories" => $categories]);

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



        $hasFile = $request->hasFile('cover') && $request->cover->isValid();

        $product = Catalogo::find($id);

        $product->descripcion = $request->title;

        // $product->category = '';

        // $product->category_id = $request->category_id;

        $product->descripcion_terapeutica = $request->description;



        // $category = Category::where('id', $request->category_id)->first();


        $product->precio_publico = $request->pricing;





        if ($hasFile) {

            $extension = $request->cover->extension();
            Storage::delete("images/$product->id.$extension");
            
            $product->extension = $extension;

        }



        ////////////////////////

        if ($product->save()) {


            if ($hasFile) {

                $request->cover->storeAs('images', "$product->id.$extension");

            }
                return redirect("/products");
                

        } else {

            return view("products.edit", ["product" => $product]);

        }

    }



    /**

     * Remove the specified resource from storage.

     *

     * @param  int $id

     * @return \Illuminate\Http\Response

     */

    public function destroy($id)

    {

        Product::destroy($id);



        return redirect('/products');

    }

}

