<?php
namespace App\Http\Controllers;





use App\Direccion;
use App\Country;

use Auth;

use Hash;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;





class Direccions extends Controller {



    protected $fillable = [

        'id', 'id_user', 'name', 'calle', 'num_ext', 'num_int', 'entre1', 'entre2',

        'references', 'codigop', 'colonia', 'estado', 'municipio', 'ciudad', 'pais', 'email', 'telefono', 'contacto',

        'status', 'guide_numer'

    ];



    public function index()

    {

        $usuario = Auth::user();

        $direccions = Direccion::where('id_user', Auth::user()->id)->get();





        return view('direccions.index')->with('direccions', $direccions)->with('usuario', $usuario);

    }



    public function create()

    {

        $direccions = new Direccion;


        $countries = Country::orderBy('name','asc')->get();
        return view('direccions.create', ["direccion" => $direccions,'countries'=>$countries]);

    }

    public function creardireccioninvitado(){
        $direccions = new Direccion;


        $countries = Country::orderBy('name','asc')->get();
        return view('direccions.create', ["direccion" => $direccions,'countries'=>$countries]);
    }





    public function store(Request $request)

    {

        $messages = [

            'name.required'      => 'El Nombre es requerido',

            'name.max'           => 'El Nombre debe contener máximo 255 caracteres',

            'email.required'     => 'El Email es requerido',

            'email.email'        => 'El Email proporcionado no es válido',

            'email.max'          => 'El Email debe contener máximo 255 caracteres',

            'telefono.required'  =>  'El telefono del remitente es requerido',

            'telefono.min'       => 'El telefono del remitente debe de contener minimo 10 caracteres',

            'contacto.required'  => 'El telefono del destinatario es requerido',

            'contacto.min'            => 'El telefono del destinatario debera contener minimo 10 caracteres',

            'pais.required'      => 'El País es requerido',

            'pais.max'           => 'El País debe contener máximo 255 caracteres',

            'estado.required'    => 'El Estado es requerido',

            'estado.max'         => 'El Estado debe contener máximo 255 caracteres',

            'ciudad.required'    => 'La Ciudad es requerida',

            'ciudad.max'         => 'La Ciudad debe contener máximo 255 caracteres',

            'municipio.required' => 'El Municipio es requerido',

            'municipio.max'      => 'El Municipio debe contener máximo 255 caracteres',

            'calle.required'     => 'La Calle es requerida',

            'calle.max'          => 'La Calle debe contener máximo 255 caracteres',

            'num_ext.required'   => 'El Número Exterior es requerido',

            'num_ext.max'        => 'El Número Exterior debe contener máximo 10 caracteres',

            'num_int.max'        => 'El Número Interior debe contener máximo 10 caracteres',

            // 'colonia.required'   => 'La Colonia es requerida',

            'colonia.max'        => 'La Colonia debe contener máximo 255 caracteres',

            // 'codigop.required'   => 'El Código Postal es requerido',

            'codigop.max'        => 'El Código Postal debe contener máximo 5 caracteres',

            'entre1.max'         => 'La referencia Calle 1 debe contener máximo 255 caracteres',

            'entre2.max'         => 'La referencia Calle 2 debe contener máximo 255 caracteres',

            'references'         => 'Las Referencias Extras deben contener máximo 255 caracteres'

        ];





        $validator = Validator::make($request->all(), [

            'name'       => 'required|max:255',

            'email'      => 'required|email|max:255',

            'telefono'   => 'required|min:10',

            'contacto'   => 'required|min:10',

            'pais'       => 'required|max:255',

            'estado'     => 'required|max:255',

            'ciudad'     => 'required|max:255',

            'municipio'  => 'required|max:255',

            'calle'      => 'required|max:255',

            'num_ext'    => 'required|max:10',

            'num_int'    => 'max:10',

            'colonia'    => 'max:255',

            // 'codigop'    => 'required|max:5',
            'codigop'    => 'max:5',

            'entre1'     => 'max:255',

            'entre2'     => 'max:255',

            'references' => 'max:255'

        ], $messages);



        if ($validator->fails()) {

            return redirect()->back()

                ->withErrors($validator)

                ->withInput();

        }



        $data = $request->all();



        $direccion = new Direccion();
        if (Auth::check()) {
            # code...
            $direccion->id_user = Auth::user()->id;

            $direccion->name = $data['name'];

            $direccion->calle = $data['calle'];

            $direccion->num_ext = $data['num_ext'];

            $direccion->num_int = $data['num_int'];

            $direccion->entre1 = $data['entre1'];

            $direccion->entre2 = $data['entre2'];

            $direccion->references = $data['references'];

            $direccion->codigop = $data['codigop'];

            $direccion->colonia = $data['colonia'];

            $direccion->estado = $data['estado'];

            $direccion->municipio = $data['municipio'];

            $direccion->ciudad = $data['ciudad'];

            $direccion->pais = $data['pais'];

            $direccion->email = $data['email'];

            $direccion->telefono = $data['telefono'];

            $direccion->contacto = $data['lada'].$data['contacto'];



            $direccion->save();





            return redirect('/user/direccion')->with(

                [

                    'feedback'   => 'Dirección guardada correctamente!',

                    'alert_type' => 'alert-success'

                ]

            );
        }
        else
        {
            $direccion->name = $data['name'];

            $direccion->calle = $data['calle'];

            $direccion->num_ext = $data['num_ext'];

            $direccion->num_int = $data['num_int'];

            $direccion->entre1 = $data['entre1'];

            $direccion->entre2 = $data['entre2'];

            $direccion->references = $data['references'];

            $direccion->codigop = $data['codigop'];

            $direccion->colonia = $data['colonia'];

            $direccion->estado = $data['estado'];

            $direccion->municipio = $data['municipio'];

            $direccion->ciudad = $data['ciudad'];

            $direccion->pais = $data['pais'];

            $direccion->email = $data['email'];

            $direccion->telefono = $data['telefono'];

            $direccion->contacto = $data['contacto'];



            $direccion->save();
            return redirect('/carrito')->with(['direccion_default'=>$direccion]);
        }


        



    }



    public function setDefault(Request $request)

    {

        $data = $request->all();



        $direccion = Direccion::find($data['default']);



        if ($direccion) {

            Direccion::where('id_user', Auth::user()->id)->update([

                'default' => 0

            ]);



            $direccion->update([

                'default' => 1

            ]);

        }



        return redirect('/user/direccion')->with(

            [

                'feedback'   => 'Dirección por defecto guardada correctamente!',

                'alert_type' => 'alert-success'

            ]

        );



    }



    public function stores(Request $request)

    {



        $direccions = new Direccion;

        $direccions->id_user = Auth::user()->id;

        $direccions->name = $request->name;

        $direccions->calle = $request->calle;

        $direccions->num_ext = $request->num_ext;

        $direccions->num_int = $request->num_int;

        $direccions->entre1 = $request->entre1;

        $direccions->entre2 = $request->entre2;

        $direccions->references = $request->references;

        $direccions->codigop = $request->codigop;

        $direccions->colonia = $request->colonia;

        $direccions->estado = $request->estado;

        $direccions->municipio = $request->municipio;

        $direccions->ciudad = $request->ciudad;

        $direccions->pais = $request->pais;

        $direccions->references = $request->references;

        $direccions->email = Auth::user()->email;

        $direccions->telefono = $request->lada.$request->telefono;

        $direccions->contacto = $request->contacto;

        $direccions->status = $request->status;

        $direccions->guide_numer = $request->guide_numer;





        if ($direccions->save()) {

            return redirect("/user");

        } else {

            return view("direccions.create", ["direccion" => $direccions]);

        }

    }

    public function delete(Request $request){
        $direccion_id = $request->input('direccion');

        $direccion = Direccion::findOrFail($direccion_id);

        $direccion->delete();

        return redirect()->back()->with([

                'feedback'   => '¡Dirección eliminada!',

                'alert_type' => 'alert-success'

            ]);
    }

    public function pais($pais)
    {
        $country = Country::where('name',$pais)->first();
        return response()->json(['pais'=>$country],200);
    }

}

  