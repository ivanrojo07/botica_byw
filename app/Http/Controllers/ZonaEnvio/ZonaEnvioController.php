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
        
        $direccion = $request->pais;
        $peso = $request->peso;
        // dd($direccion);
        $envio = ZonaEnvio::where('peso', '>=', "$peso")->first();
        if ($direccion == "USA" || $direccion == "usa" || $direccion == "Estados Unidos de América" || $direccion == 'Estados Unidos' || $direccion == 'estados unidos' || $direccion == "Estados Unidos de America" || $direccion == "estados unidos de america" || $direccion == "EE UU"|| $direccion == "ee uu"|| $direccion == "eu") {
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
       
        elseif (mb_strtolower($direccion) == "costa rica" || mb_strtolower($direccion) == "el salvador" || mb_strtolower($direccion) == "guatemala" || mb_strtolower($direccion) == "honduras" || mb_strtolower($direccion) == "nicaragua" || mb_strtolower($direccion) == "panama" ) {
            # code...
            $precio_envio = number_format((($envio->precio_b+($envio->precio_b*(0.40)))),2);
            // dd('precio b');
            }
        elseif (mb_strtolower($direccion) == "colombia" || mb_strtolower($direccion) == "r. dominicana") {
            # code...
            $precio_envio = number_format((($envio->precio_c+($envio->precio_c*(0.40)))),2);;
            // dd('precio c');
            }

        elseif ( mb_strtolower($direccion) == "argentina" || mb_strtolower($direccion) == "bolivia"  || mb_strtolower($direccion) == "chile" || mb_strtolower($direccion) == "ecuador" || mb_strtolower($direccion) == "mexico" || mb_strtolower($direccion) == "paraguay" || mb_strtolower($direccion) == "peru" || mb_strtolower($direccion) == "trinidad y tobago" || mb_strtolower($direccion) == "uruguay"|| mb_strtolower($direccion) == "venezuela") {
                # code...
                $precio_envio = number_format((($envio->precio_d+($envio->precio_d*(0.40)))),2);
                // dd('precio d');
            }

        elseif (mb_strtolower($direccion) == "aruba" || mb_strtolower($direccion) == "brasil" || mb_strtolower($direccion) == "coracao" || mb_strtolower($direccion) == "haiti" || mb_strtolower($direccion) == "jamaica" || mb_strtolower($direccion) == "sint maarten") {
                # code...
                $precio_envio = number_format((($envio->precio_e+($envio->precio_e*(0.40)))),2);
                // dd('precio e');
            }
        elseif (mb_strtolower($direccion) == "anguila" || mb_strtolower($direccion) == "antigua y barbuda" || mb_strtolower($direccion) == "antillas holandesas" || mb_strtolower($direccion) == "bahamas" || mb_strtolower($direccion) == "barbados" || mb_strtolower($direccion) == "belice" || mb_strtolower($direccion) == "bermudas" || mb_strtolower($direccion) == "bonaire" || mb_strtolower($direccion) == "canada" || mb_strtolower($direccion) == "cuba" || mb_strtolower($direccion) == "dominica" || mb_strtolower($direccion) == "granada" || mb_strtolower($direccion) == "guadalupe" || mb_strtolower($direccion) == "islas caiman" || mb_strtolower($direccion) == "islas marianas" || mb_strtolower($direccion) == "islas minor" || mb_strtolower($direccion) == "islas virg britanicas" || mb_strtolower($direccion) == "islas virginias am" || mb_strtolower($direccion) == "martinica" || mb_strtolower($direccion) == "montserrat" || mb_strtolower($direccion) == "puerto rico" || mb_strtolower($direccion) == "road town arpt" || mb_strtolower($direccion) == "roosevelt field" || mb_strtolower($direccion) == "santa lucia" || mb_strtolower($direccion) == "st jean arpt" || mb_strtolower($direccion) == "st thomas" || mb_strtolower($direccion) == "st bartolome" || mb_strtolower($direccion) == "st kitts" || mb_strtolower($direccion) == "st vincent" || mb_strtolower($direccion) == "turcas y caicos" || mb_strtolower($direccion) == "wallis fortuna") {
            # code...
            $precio_envio = number_format((($envio->precio_f+($envio->precio_f*(0.40)))),2);

        }
        elseif (mb_strtolower($direccion) == "alemania" || mb_strtolower($direccion) == "andorra" || mb_strtolower($direccion) == "armenia" || mb_strtolower($direccion) == "austria" || mb_strtolower($direccion) == "azerbayan" || mb_strtolower($direccion) == "banja luka arpt" || mb_strtolower($direccion) == "" || mb_strtolower($direccion) == "belgica" || mb_strtolower($direccion) == "bielorrusia" || mb_strtolower($direccion) == "bosnia herzegovina" || mb_strtolower($direccion) == "bulgaria" || mb_strtolower($direccion) == "c. vaticano" || mb_strtolower($direccion) == "croacia" || mb_strtolower($direccion) == "dinamarca" || mb_strtolower($direccion) == "eslovaquia" || mb_strtolower($direccion) == "eslovenia" || mb_strtolower($direccion) == "españa" || mb_strtolower($direccion) == "estonia" || mb_strtolower($direccion) == "finlandia" || mb_strtolower($direccion) == "francia" || mb_strtolower($direccion) == "georgia" || mb_strtolower($direccion) == "gibraltar" || mb_strtolower($direccion) == "grecia" || mb_strtolower($direccion) == "heathrow" || mb_strtolower($direccion) == "holanda" || mb_strtolower($direccion) == "hungria" || mb_strtolower($direccion) == "irlanda" || mb_strtolower($direccion) == "islandia" || mb_strtolower($direccion) == "islas faroe" || mb_strtolower($direccion) == "italia" || mb_strtolower($direccion) == "kazajstan" || mb_strtolower($direccion) == "kyrgyzstan" || mb_strtolower($direccion) == "letonia" || mb_strtolower($direccion) == "lienchestein" || mb_strtolower($direccion) == "lituania" || mb_strtolower($direccion) == "reino unido" || mb_strtolower($direccion) == "luxemburgo" || mb_strtolower($direccion) == "malta" || mb_strtolower($direccion) == "moldavia" || mb_strtolower($direccion) == "montenegro" || mb_strtolower($direccion) == "north front arpt" || mb_strtolower($direccion) == "noruega" || mb_strtolower($direccion) == "polonia" || mb_strtolower($direccion) == "portugal" || mb_strtolower($direccion) == "monaco" || mb_strtolower($direccion) == "inglaterra" || mb_strtolower($direccion) == "republica checa" || mb_strtolower($direccion) == "rumania" || mb_strtolower($direccion) == "san marino" || mb_strtolower($direccion) == "serbia" || mb_strtolower($direccion) == "serbia montenegro" || mb_strtolower($direccion) == "suecia" || mb_strtolower($direccion) == "suiza" || mb_strtolower($direccion) == "tayikistan" || mb_strtolower($direccion) == "ucrania" || mb_strtolower($direccion) == "uzbekistan") {
            # code...
            $precio_envio = number_format((($envio->precio_g+($envio->precio_g*(0.40)))),2);
        }
        elseif (mb_strtolower($direccion) == "australia" || mb_strtolower($direccion) == "bangladesh" || mb_strtolower($direccion) == "bhutan" || mb_strtolower($direccion) == "birmania" || mb_strtolower($direccion) == "brunei" || mb_strtolower($direccion) == "camboya" || mb_strtolower($direccion) == "china" || mb_strtolower($direccion) == "corea del norte" || mb_strtolower($direccion) == "corea del sur" || mb_strtolower($direccion) == "filipinas" || mb_strtolower($direccion) == "guam" || mb_strtolower($direccion) == "guayana" || mb_strtolower($direccion) == "guayana francesa" || mb_strtolower($direccion) == "guinea ecuatorial" || mb_strtolower($direccion) == "hong kong" || mb_strtolower($direccion) == "indonesia" || mb_strtolower($direccion) == "isa nauru" || mb_strtolower($direccion) == "islas cook" || mb_strtolower($direccion) == "islas salomon" || mb_strtolower($direccion) == "japon" || mb_strtolower($direccion) == "kiribati" || mb_strtolower($direccion) == "laos" || mb_strtolower($direccion) == "macao" || mb_strtolower($direccion) == "malasia" || mb_strtolower($direccion) == "maldivas" || mb_strtolower($direccion) == "myanmar" || mb_strtolower($direccion) == "nepal" || mb_strtolower($direccion) == "nueva caledonia" || mb_strtolower($direccion) == "nueva zelanda" || mb_strtolower($direccion) == "papua nueva guinea" || mb_strtolower($direccion) == "singapur" || mb_strtolower($direccion) == "sri lanka" || mb_strtolower($direccion) == "vanuatu" || mb_strtolower($direccion) == "taiwan" || mb_strtolower($direccion) == "thailandia" || mb_strtolower($direccion) == "vietnam") {
            # code...
            $precio_envio = number_format((($envio->precio_h+($envio->precio_h*(0.40)))),2);
        }
        else{
            $precio_envio = "tu dirección esta erronea o tu compra no puede ser enviada a"+$direccion;
        }
        return response()->json(['precio'=>$precio_envio],200);

        // return  view('shopping_carts.envios',['precio_envio'=>$precio_envio,'total'=>$request->input('total')]);
        

        
    }
}
