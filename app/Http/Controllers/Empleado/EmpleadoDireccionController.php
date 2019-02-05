<?php

namespace App\Http\Controllers\Empleado;

use App\Direccion;
use App\ShoppingCart;
use App\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmpleadoDireccionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShoppingCart $pedido)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ShoppingCart $pedido)
    {
        //
        $direccion = new Direccion;
        $countries = Country::orderBy('name','asc')->get();
        return view('admin.pedidos.direccion.form',['pedido'=>$pedido,'edit'=>false,'direccion'=>$direccion,'countries'=>$countries]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShoppingCart $pedido,Request $request)
    {
        //
        $user = $pedido->user;
        // dd($request->all());
        $direccion = new Direccion($request->all());
        $direccion->id_user= $user->id;
        $direccion->contacto = $request->lada.$request->contacto;
        $direccion->save();
        // dd($direccion);
        // falta user_id
        
        // $user->direccions()->save($direccion);
        $pedido->direccion_id=$direccion->id;
        $pedido->totalenvio = $request->envio;
        $pedido->save();
        // $pedido->peso = $request->peso;
        return redirect()->route('pedidos.show',['pedido'=>$pedido]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingCart $pedido,Direccion $direccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingCart $pedido,Direccion $direccion)
    {
        //
        $countries = Country::orderBy('name','asc')->get();
        return view('admin.pedidos.direccion.form',['pedido'=>$pedido,'edit'=>true,'direccion'=>$direccion,'countries'=>$countries]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function update(ShoppingCart $pedido,Request $request, Direccion $direccion)
    {
        //
        $direccion->update($request->all());
        // $direccion->id_user= $user->id;
        $direccion->contacto = $request->lada.$request->contacto;
        $direccion->save();
        // dd($direccion);
        // falta user_id
        
        // $user->direccions()->save($direccion);
        $pedido->direccion_id=$direccion->id;
        $pedido->totalenvio = $request->envio;
        $pedido->save();
        // $pedido->peso = $request->peso;
        return redirect()->route('pedidos.show',['pedido'=>$pedido]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Direccion  $direccion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingCart $pedido,Direccion $direccion)
    {
        //
    }
}
