<?php

namespace App\Http\Controllers\ZonaEnvio;

use App\Http\Controllers\Controller;
use App\ZonaEnvio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ZonaEnvioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $envios = ZonaEnvio::get();
        return view('envios.index',['envios'=>$envios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $envio = new ZonaEnvio;
        $edit = false;
        return view('envios.create',['envio'=>$envio,'edit'=>$edit]);
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
        $messages = [

            'peso.unique' => 'Este peso ya esta registrado',
            'peso.required' => 'El campo peso es requerido',
            'precio_a.required' => 'El campo Precio Zona A es requerido',
            'precio_b.required' => 'El campo Precio Zona B es requerido',
            'precio_c.required' => 'El campo Precio Zona C es requerido',
            'precio_d.required' => 'El campo Precio Zona D es requerido',
            'precio_e.required' => 'El campo Precio Zona E es requerido',
            'precio_f.required' => 'El campo Precio Zona F es requerido',
            'precio_g.required' => 'El campo Precio Zona G es requerido',
            'precio_h.required' => 'El campo Precio Zona H es requerido',
            'precio_i.required' => 'El campo Precio Zona I es requerido',


        ];
        $validator = Validator::make($request->all(),[
            'peso' => 'required|unique:zona_envios',
            'precio_a' =>'required',
            'precio_b' =>'required',
            'precio_c' =>'required',
            'precio_d' =>'required',
            'precio_e' =>'required',
            'precio_f' =>'required',
            'precio_g' =>'required',
            'precio_h' =>'required',
            'precio_i' =>'required',
        ], $messages);

        if ($validator->fails()) {
            # code...
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            # code...
            // dd($request->all());
            $envio = ZonaEnvio::create($request->all());
            return redirect()->route('envios.index')->with([

                    'feedback'   => '¡Tarifa agregada con éxito!',

                    'alert_type' => 'alert-success'

                ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ZonaEnvio  $zonaEnvio
     * @return \Illuminate\Http\Response
     */
    public function show(ZonaEnvio $zonaEnvio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ZonaEnvio  $zonaEnvio
     * @return \Illuminate\Http\Response
     */
    public function edit(ZonaEnvio $envio)
    {
        //
        // dd($envio);
        $edit = true;
        return view('envios.create',['envio'=>$envio,'edit'=>$edit]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ZonaEnvio  $zonaEnvio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ZonaEnvio $envio)
    {
        //
        $envio->update($request->all());
        return redirect()->route('envios.index')->with([

                    'feedback'   => '¡Tarifa actualizada con éxito!',

                    'alert_type' => 'alert-success'

                ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ZonaEnvio  $zonaEnvio
     * @return \Illuminate\Http\Response
     */
    public function destroy(ZonaEnvio $zonaEnvio)
    {
        //
    }
}
