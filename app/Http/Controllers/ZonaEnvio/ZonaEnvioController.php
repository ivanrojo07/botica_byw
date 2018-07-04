<?php

namespace App\Http\Controllers\ZonaEnvio;

use App\CambioMoneda;
use App\Direccion;
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

    public function envios(Request $request){
        $envio = ZonaEnvio::find($request->input('envio_id'));
        $direccion = Direccion::find($request->input('direccion_id'));
        $cambio = CambioMoneda::first()->get()->pluck('pesos');
        // dd($request->all());
        if ($direccion->pais == "USA" || $direccion->pais == "usa" || $direccion->pais == "Estados Unidos de América" || $direccion->pais == 'Estados Unidos' || $direccion->pais == 'estados unidos' || $direccion->pais == "Estados Unidos de America" || $direccion->pais == "estados unidos de america" || $direccion->pais == "EE UU"|| $direccion->pais == "ee uu"|| $direccion->pais == "eu") {
            # code...
            if ($direccion->estado == "Florida" || $direccion->estado == "florida" ||$direccion->estado == "FL" || $direccion->estado == "fl") {
                # code...
                if ($direccion->ciudad == 'miami'|| $direccion->ciudad == 'Miami') {
                    # code...
                    $precio_envio = number_format((($envio->precio_a+($envio->precio_a*(0.40)))),2);
                    // dd('precio a');
                }
                
            }
            
        }
       
        elseif (mb_strtolower($direccion->pais) == "costa rica" || mb_strtolower($direccion->pais) == "el salvador" || mb_strtolower($direccion->pais) == "guatemala" || mb_strtolower($direccion->pais) == "honduras" || mb_strtolower($direccion->pais) == "nicaragua" || mb_strtolower($direccion->pais) == "panama" ) {
            # code...
            $precio_envio = number_format((($envio->precio_b+($envio->precio_b*(0.40)))),2);
            // dd('precio b');
            }
        elseif (mb_strtolower($direccion->pais) == "colombia" || mb_strtolower($direccion->pais) == "r. dominicana") {
            # code...
            $precio_envio = number_format((($envio->precio_c+($envio->precio_c*(0.40)))),2);;
            // dd('precio c');
            }

        elseif ( mb_strtolower($direccion->pais) == "argentina" || mb_strtolower($direccion->pais) == "bolivia"  || mb_strtolower($direccion->pais) == "chile" || mb_strtolower($direccion->pais) == "ecuador" || mb_strtolower($direccion->pais) == "méxico" || mb_strtolower($direccion->pais) == "paraguay" || mb_strtolower($direccion->pais) == "peru" || mb_strtolower($direccion->pais) == "trinidad y tobago" || mb_strtolower($direccion->pais) == "uruguay"|| mb_strtolower($direccion->pais) == "venezuela") {
                # code...
                $precio_envio = number_format((($envio->precio_d+($envio->precio_d*(0.40)))),2);
                // dd('precio d');
            }

        elseif (mb_strtolower($direccion->pais) == "aruba" || mb_strtolower($direccion->pais) == "brasil" || mb_strtolower($direccion->pais) == "coracao" || mb_strtolower($direccion->pais) == "haiti" || mb_strtolower($direccion->pais) == "jamaica" || mb_strtolower($direccion->pais) == "sint maarten") {
                # code...
                $precio_envio = number_format((($envio->precio_e+($envio->precio_e*(0.40)))),2);
                // dd('precio e');
            }
        elseif (mb_strtolower($direccion->pais) == "anguila" || mb_strtolower($direccion->pais) == "antigua y barbuda" || mb_strtolower($direccion->pais) == "antillas holandesas" || mb_strtolower($direccion->pais) == "bahamas" || mb_strtolower($direccion->pais) == "barbados" || mb_strtolower($direccion->pais) == "belice" || mb_strtolower($direccion->pais) == "bermudas" || mb_strtolower($direccion->pais) == "bonaire" || mb_strtolower($direccion->pais) == "canada" || mb_strtolower($direccion->pais) == "cuba" || mb_strtolower($direccion->pais) == "dominica" || mb_strtolower($direccion->pais) == "granada" || mb_strtolower($direccion->pais) == "guadalupe" || mb_strtolower($direccion->pais) == "islas caiman" || mb_strtolower($direccion->pais) == "islas marianas" || mb_strtolower($direccion->pais) == "islas minor" || mb_strtolower($direccion->pais) == "islas virg britanicas" || mb_strtolower($direccion->pais) == "islas virginias am" || mb_strtolower($direccion->pais) == "martinica" || mb_strtolower($direccion->pais) == "montserrat" || mb_strtolower($direccion->pais) == "puerto rico" || mb_strtolower($direccion->pais) == "road town arpt" || mb_strtolower($direccion->pais) == "roosevelt field" || mb_strtolower($direccion->pais) == "santa lucia" || mb_strtolower($direccion->pais) == "st jean arpt" || mb_strtolower($direccion->pais) == "st thomas" || mb_strtolower($direccion->pais) == "st bartolome" || mb_strtolower($direccion->pais) == "st kitts" || mb_strtolower($direccion->pais) == "st vincent" || mb_strtolower($direccion->pais) == "turcas y caicos" || mb_strtolower($direccion->pais) == "wallis fortuna") {
            # code...
            $precio_envio = number_format((($envio->precio_f+($envio->precio_f*(0.40)))),2);

        }
        elseif (mb_strtolower($direccion->pais) == "alemania" || mb_strtolower($direccion->pais) == "andorra" || mb_strtolower($direccion->pais) == "armenia" || mb_strtolower($direccion->pais) == "austria" || mb_strtolower($direccion->pais) == "azerbayan" || mb_strtolower($direccion->pais) == "banja luka arpt" || mb_strtolower($direccion->pais) == "" || mb_strtolower($direccion->pais) == "belgica" || mb_strtolower($direccion->pais) == "bielorrusia" || mb_strtolower($direccion->pais) == "bosnia herzegovina" || mb_strtolower($direccion->pais) == "bulgaria" || mb_strtolower($direccion->pais) == "c. vaticano" || mb_strtolower($direccion->pais) == "croacia" || mb_strtolower($direccion->pais) == "dinamarca" || mb_strtolower($direccion->pais) == "eslovaquia" || mb_strtolower($direccion->pais) == "eslovenia" || mb_strtolower($direccion->pais) == "españa" || mb_strtolower($direccion->pais) == "estonia" || mb_strtolower($direccion->pais) == "finlandia" || mb_strtolower($direccion->pais) == "francia" || mb_strtolower($direccion->pais) == "georgia" || mb_strtolower($direccion->pais) == "gibraltar" || mb_strtolower($direccion->pais) == "grecia" || mb_strtolower($direccion->pais) == "heathrow" || mb_strtolower($direccion->pais) == "holanda" || mb_strtolower($direccion->pais) == "hungria" || mb_strtolower($direccion->pais) == "irlanda" || mb_strtolower($direccion->pais) == "islandia" || mb_strtolower($direccion->pais) == "islas faroe" || mb_strtolower($direccion->pais) == "italia" || mb_strtolower($direccion->pais) == "kazajstan" || mb_strtolower($direccion->pais) == "kyrgyzstan" || mb_strtolower($direccion->pais) == "letonia" || mb_strtolower($direccion->pais) == "lienchestein" || mb_strtolower($direccion->pais) == "lituania" || mb_strtolower($direccion->pais) == "reino unido" || mb_strtolower($direccion->pais) == "luxemburgo" || mb_strtolower($direccion->pais) == "malta" || mb_strtolower($direccion->pais) == "moldavia" || mb_strtolower($direccion->pais) == "montenegro" || mb_strtolower($direccion->pais) == "north front arpt" || mb_strtolower($direccion->pais) == "noruega" || mb_strtolower($direccion->pais) == "polonia" || mb_strtolower($direccion->pais) == "portugal" || mb_strtolower($direccion->pais) == "monaco" || mb_strtolower($direccion->pais) == "inglaterra" || mb_strtolower($direccion->pais) == "republica checa" || mb_strtolower($direccion->pais) == "rumania" || mb_strtolower($direccion->pais) == "san marino" || mb_strtolower($direccion->pais) == "serbia" || mb_strtolower($direccion->pais) == "serbia montenegro" || mb_strtolower($direccion->pais) == "suecia" || mb_strtolower($direccion->pais) == "suiza" || mb_strtolower($direccion->pais) == "tayikistan" || mb_strtolower($direccion->pais) == "ucrania" || mb_strtolower($direccion->pais) == "uzbekistan") {
            # code...
            $precio_envio = number_format((($envio->precio_g+($envio->precio_g*(0.40)))),2);
        }
        elseif (mb_strtolower($direccion->pais) == "australia" || mb_strtolower($direccion->pais) == "bangladesh" || mb_strtolower($direccion->pais) == "bhutan" || mb_strtolower($direccion->pais) == "birmania" || mb_strtolower($direccion->pais) == "brunei" || mb_strtolower($direccion->pais) == "camboya" || mb_strtolower($direccion->pais) == "china" || mb_strtolower($direccion->pais) == "corea del norte" || mb_strtolower($direccion->pais) == "corea del sur" || mb_strtolower($direccion->pais) == "filipinas" || mb_strtolower($direccion->pais) == "guam" || mb_strtolower($direccion->pais) == "guayana" || mb_strtolower($direccion->pais) == "guayana francesa" || mb_strtolower($direccion->pais) == "guinea ecuatorial" || mb_strtolower($direccion->pais) == "hong kong" || mb_strtolower($direccion->pais) == "indonesia" || mb_strtolower($direccion->pais) == "isa nauru" || mb_strtolower($direccion->pais) == "islas cook" || mb_strtolower($direccion->pais) == "islas salomon" || mb_strtolower($direccion->pais) == "japon" || mb_strtolower($direccion->pais) == "kiribati" || mb_strtolower($direccion->pais) == "laos" || mb_strtolower($direccion->pais) == "macao" || mb_strtolower($direccion->pais) == "malasia" || mb_strtolower($direccion->pais) == "maldivas" || mb_strtolower($direccion->pais) == "myanmar" || mb_strtolower($direccion->pais) == "nepal" || mb_strtolower($direccion->pais) == "nueva caledonia" || mb_strtolower($direccion->pais) == "nueva zelanda" || mb_strtolower($direccion->pais) == "papua nueva guinea" || mb_strtolower($direccion->pais) == "singapur" || mb_strtolower($direccion->pais) == "sri lanka" || mb_strtolower($direccion->pais) == "vanuatu" || mb_strtolower($direccion->pais) == "taiwan" || mb_strtolower($direccion->pais) == "thailandia" || mb_strtolower($direccion->pais) == "vietnam") {
            # code...
            $precio_envio = number_format((($envio->precio_h+($envio->precio_h*(0.40)))),2);
        }
        else{
            $precio_envio = "tu dirección esta erronea o tu compra no puede ser enviada a"+$direccion->pais;
        }
        // dd($request->input('total'));

        return  view('shopping_carts.envios',['precio_envio'=>$precio_envio,'total'=>$request->input('total')]);
        

        
    }
}
