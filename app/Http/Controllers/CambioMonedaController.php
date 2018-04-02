<?php

namespace App\Http\Controllers;

use App\CambioMoneda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CambioMonedaController extends Controller
{
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request->all());

        $moneda = CambioMoneda::updateOrCreate(['id'=>1],['pesos'=>$request->moneda]);
        return redirect()->back()->with('status', 'Cambio de la moneda actualizado con éxito');
    }

    
}
