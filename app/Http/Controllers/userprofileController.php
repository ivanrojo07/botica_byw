<?php



namespace App\Http\Controllers;





use App\CambioMoneda;
use App\Http\Controllers\Controller;
use App\user;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Validator;



class userprofileController extends Controller {



    public function _construct()

    {

        $this->middleware('auth');

    }



    public function user()

    {

        $cambio = CambioMoneda::get()->first();
        // dd($cambio);
        return view('user.user',['cambio'=>$cambio]);

    }



    public function profile()

    {
        return View('user.profile');

    }



    public function updateProfile(Request $request)

    {

        $rules = ['image' => 'required|image|max:1024*1024*1',];

        $messages = [

            'image.required' => 'La imagen es requerida',

            'image.image'    => 'Formato no permitido',

            'image.max'      => 'El máximo permitido es 1 MB',

        ];

        $validator = Validator::make($request->all(), $rules, $messages);



        if ($validator->fails()) {

            return redirect('user/profile')->withErrors($validator);

        } else {

            $name = str_random(30) . '-' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move('perfiles', $name);

            $user = new User;

            $user->where('email', '=', Auth::user()->email)

                ->update(['imgprofile' => 'perfiles/' . $name]);



            return redirect('user')->with('status', 'Su imagen de perfil ha sido cambiada con éxito');

        }





    }



    public function password()

    {

        return View('user.password');

    }





    public function updatePassword(Request $request)

    {

        $rules = [

            'mypassword' => 'required',

            'password'   => 'required|confirmed|min:6|max:18',

        ];



        $messages = [

            'mypassword.required' => 'El campo es requerido',

            'password.required'   => 'El campo es requerido',

            'password.confirmed'  => 'Los passwords no coinciden',

            'password.min'        => 'El mínimo permitido son 6 caracteres',

            'password.max'        => 'El máximo permitido son 18 caracteres',

        ];



        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            return redirect('user/password')->withErrors($validator);

        } else {

            if (Hash::check($request->mypassword, Auth::user()->password)) {

                $user = new User;

                $user->where('email', '=', Auth::user()->email)

                    ->update(['password' => bcrypt($request->password)]);



                return redirect('user')->with('status', 'Password cambiado con éxito');

            } else {

                return redirect('user/password')->with('message', 'Credenciales incorrectas');

            }

        }

    }

}

