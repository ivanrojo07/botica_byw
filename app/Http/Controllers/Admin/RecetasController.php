<?php namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Order;
use App\ShoppingCart;

class RecetasController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {

        $recetas = Order::with(['shoppingcart' => function ($query) {
            $query->where('status', 'approve');
        }])->paginate(30);

        return view('admin.recetas.index', compact('recetas'));
    }
}