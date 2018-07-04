<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


    public function __construct(){

        $this->middleware('auth');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $usuarios = User::where(function($query){
            $query->where('rol','admin')->orWhere('rol','emple');
        })->get();
        return view('admin.user.index',['usuarios'=>$usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $usuario = new User();
        $edit = false;
        return view('admin.user.create',['usuario'=>$usuario,'edit'=>$edit]);
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
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:195',
            'email' => 'required|string|email|max:255|unique:users',
            'rol' => 'required|string',
            'password' => 'required|string|min:6|confirmed',

        ]);
        if ($validator->fails()) {
            # code...
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $data = $request->all();
            // dd($data);
            $usuario = User::create([
                'name' => $data['name'],
                'email' =>$data['email'],
                
                'password'=>bcrypt($data['password'])
            ]);
            $usuario->rol = $data['rol'];
            $usuario->save();
            return redirect()->route('empleados.index')->with([
                'feedback'=>'Empleado creado correctamente',
                'alert_type' =>'alert-success'

            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        //
        $usuario = User::findOrFail($user_id);
        // dd($usuario);
        $edit=true;
        return view('admin.user.create',['usuario'=>$usuario,'edit'=>$edit]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $empleado)
    {
        //
        // dd($empleado);
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:195',
            'email' => 'required|string|email|max:255',
            'rol' => 'required|string',
        ]);
         if ($validator->fails()) {
            # code...
            return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $data = $request->all();
            $empleado->update(['name'=>$data['name'],'email'=>$data['email']]);
            $empleado->rol = $data['rol'];
            $empleado->save();
            return redirect()->route('empleados.index')->with([
                'feedback'=>'Empleado actualizado correctamente',
                'alert_type' =>'alert-success'

            ]);
        }

        // return view('admin.user.create',['usuario'=>$usuario,'edit'=>$edit]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $empleado)
    {
        //
        if ($empleado->rol == 'normal') {
            # code...
            return redirect()->back()->with([
                'feedback'=>'Empleado eliminado',
                'alert_type' =>'alert-success'

            ]);
        }
        else {

            $empleado->delete();
            return redirect()->back()->with([
                    'feedback'=>'Empleado eliminado',
                    'alert_type' =>'alert-success'
                ]);
        }
    }
}
