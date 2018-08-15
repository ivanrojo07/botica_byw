<?php

namespace App\Http\Controllers\Tracking;

use App\Http\Controllers\Controller;
use App\Order;
use App\ShoppingCart;
use App\StatusTracking;
use App\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TrackingController extends Controller
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
        // $carts=ShoppingCart::getAll();
        // $carts=ShoppingCart::where('status','approve')->get();
        // dd($carts);

        $trackings=Tracking::orderBy('created_at', 'desc')->get();
        $orders=Order::where(function ($query){
            $query->where('status','empaquetado')
            ->orWhere('status','en tramite');
        })->get();
        // dd($orders);


        return view('tracking.index',['trackings'=>$trackings,'orders'=>$orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('tracking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guide_numer = $request->input('hawb');
        $orden = Order::find($request->input('orden_id'));
        // dd(isset($orden->trackings));
        $orden->guide_numer .= "$guide_numer ";
        $orden->status = "en tramite";
        if (isset($orden->trackings)) {
            # code...
            $orden->tracking_at = \Carbon\Carbon::now('America/Mexico_City');
        }
        $tracking=Tracking::create($request->all());
        $orden->save();
        // dd($orden);

        return redirect('tracking')->with(

                [

                    'feedback'   => "Se creo el tracking #$tracking->hawb correctamente!",

                    'alert_type' => 'alert-success'

                ]

            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tracking  $tracking
     * @return \Illuminate\Http\Response
     */
    public function show(Tracking $tracking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tracking  $tracking
     * @return \Illuminate\Http\Response
     */
    public function edit(Tracking $tracking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tracking  $tracking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tracking $tracking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tracking  $tracking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tracking $tracking)
    {
        //
    }

    public function search(Request $request){
        $query = $request->input('busqueda');
        // dd($query);
        $wordsquery = explode(' ',$query);
        $wordquery = $wordsquery[0];
        // dd($wordquery);
        if ($wordquery == "") {
            # code...
            $trackings = Tracking::get();

        }
        else {

            $trackings = Tracking::whereHas('orden.shoppingcart',function($qy) use ($wordquery){
                // BUSQUEDA POR LA RELACION TRACKING-ORDEN-SHOPPINGCART POR CUSTOMID
                $qy->where('customid',$wordquery);
            })->orWhere(function ($q) use ($wordquery){
                // BUSQUEDA POR EL HAWB DEL TRACKING
                $q->orWhere('hawb',$wordquery);
            })->get();
        }


        

        return view('tracking.busqueda',['trackings'=>$trackings]);
    }

    public function status(Tracking $tracking)
    {
        return view('tracking.statusform',['tracking'=>$tracking]);
    }
}
