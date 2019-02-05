<?php

namespace App\Http\Controllers\Empleado;

use App\ShoppingCart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpleadoShoppingCartsController extends Controller
{



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $pedidos = ShoppingCart::where('status','create')->get();
        // dd($pedidos);
        return view('admin.pedidos.index',['pedidos'=>$pedidos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        dd("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        dd("store");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingCart $pedido)
    {
        //
        return view('admin.pedidos.show',['pedido'=>$pedido]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingCart $pedido)
    {
        //
        dd("edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShoppingCart $pedido)
    {
        //
        dd("update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShoppingCart  $shoppingCart
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingCart $pedido)
    {
        //
        dd("destroy");
    }
}
