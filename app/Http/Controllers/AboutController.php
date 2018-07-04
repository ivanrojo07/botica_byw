<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;

class AboutController extends Controller
{
    public function create()
    {
        return view('about.contact');
    }

    public function store(ContactFormRequest $request)
  	{

    	 \Mail::send('emails.contact',
        array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'user_message' => $request->get('message')
        ), function($message)
    {
        $message->to('info@tufarmacialatina.com', 'TuFarmaciaLatina')->subject('Info Farmacia Latina');
    });

  return \Redirect::route('contact')->with('message', 'Gracias por Contactarnos, pronto recibiras respuesta');

  	}	
}
