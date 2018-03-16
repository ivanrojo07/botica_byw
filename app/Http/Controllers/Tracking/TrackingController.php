<?php

namespace App\Http\Controllers\Tracking;

use App\Tracking;
use App\StatusTracking;
use App\Order;
use App\ShoppingCart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        $trackings=Tracking::orderBy('created_at', 'desc')->paginate(30);
        $orders=Order::get();
        $carts=ShoppingCart::get();

        return view('tracking.index',['trackings'=>$trackings,
                                       'orders'  =>$orders,
                                       'carts'   =>$carts]);
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

       // dd($request);
        $tracking=Tracking::create($request->all());

        return redirect('tracking');
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

        $trackings = Tracking::whereHas('orden.shoppingcart',function($qy) use ($wordquery){
            $qy->where('customid',$wordquery);
        })->orWhere(function ($q) use ($wordquery){
            $q->orWhere('hawb','LIKE', "%$wordquery%");
        })->get();

        // if ($query == null) {
        //     # code...
        //     $trakings = Tracking::get()->all();
        // }
        // $customid = ShoppingCart::where(function($q) use ($wordsquery){
        //     foreach ($wordsquery as $word) {
        //         # code...
        //         // $q->orWhere('customid', 'LIKE',"%$word%");
        //         $q->orWhere('customid',"$word");
        //     }
        // })->first();
        // if ($customid) {
        //     # code...
        //     $trackings = $customid->order;
        //     $trackings = $trackings->tracking;
        // }
        // else{
        //     // $trackings="";
        //     $trackings = Tracking::where(function ($quer) use ($wordsquery){
        //     foreach ($wordsquery as $word) {
        //         # code...
        //         $quer->orWhere('hawb',"$word");
        //     }
        //     })->first();
        // }


        // dd($trackings);

        return view('tracking.busqueda',['trackings'=>$trackings]);
    }
}
