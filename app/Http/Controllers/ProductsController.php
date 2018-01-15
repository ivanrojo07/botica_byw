<?php

namespace App\Http\Controllers;


use App\Category;
use App\ProductComment;
use App\Services\FavoriteProduct;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Auth;

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
        $products = Product::orderBy('id')->Paginate(35);

        return view("products.index", ["products" => $products]);
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
        $product = Product::find($id);

        #obtenemos las reseñas del producto
        $product_comments = ProductComment::where('product_id', $id)->get();

        return view('products.show', compact('product', 'favoriteProduct', 'product_comments'));
    }

    public function statics(Request $request, FavoriteProduct $favoriteProduct)
    {

        $products = new Product();

        $filters = $request->all();

        $category_selected = '';

        $categories = Category::where('slug', '!=', 'Promociones')->get();

        $old_inputs = [
            'title'            => '',
            'max_price'        => '',
            'order_created_at' => ''
        ];

        #filtrar productos por categoria, precio, titulo y recien agregados

        if (isset($filters['category']) && $filters['category'] != '' && $filters['category'] != 'all') {

            $category_selected = Category::whereSlug($filters['category'])->first();

            if ($category_selected) {
                $products = $products->whereCategoryId($category_selected->id);
            } else {
                $products->all();
            }
        }

        if (isset($filters['max_price']) && $filters['max_price'] != '' && is_numeric($filters['max_price']) && $filters['max_price'] > 0) {
            $products = $products->where('pricing', '<=', $filters['max_price']);
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

        $products = $products->orderBy('title')->Paginate(9)->appends($filters);


        return view('products.static', compact('products', 'category_selected', 'categories', 'favoriteProduct'))->with($old_inputs);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $product = Product::find($id);

        $categories = Category::all();

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
        $product = Product::find($id);
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


        if ($hasFile) {
            $extension = $request->cover->extension();
            $product->extension = $extension;
        }

        ////////////////////////
        if ($product->save()) {
            return redirect("/products");
            if ($hasFile) {
                $request->cover->storeAs('images', "$product->id.$extension");
            }
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
