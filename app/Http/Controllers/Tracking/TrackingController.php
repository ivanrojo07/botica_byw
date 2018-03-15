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
        if ($query == " ") {
            # code...
            $trakings = Tracking::get();
        }
        $wordsquery = explode(' ',$query);

        $customid = ShoppingCart::where(function($q) use ($wordsquery){
            foreach ($wordsquery as $word) {
                # code...
                // $q->orWhere('customid', 'LIKE',"%$word%");
                $q->orWhere('customid',"$word");
            }
        })->first();
        $trackings = $customid->order;
        $trackings = $trackings->tracking;
        // $trackings = Tracking::with(['orden.shoppingcart'=>function($q) use($wordsquery){
        //     foreach ($wordsquery as $word) {
        //         $q->where('customid','LIKE',"%$word%");
        //     }
        // }])->first();
        // $trackings = Tracking::with(['orden.shoppingCart'=>function($q) use ($wordsquery){
        //     foreach ($wordsquery as $word) {
        //         # code...
        //         $q->orWhere('customid', 'LIKE',"%$word%");
        //     }
        // }])->get();

        // ->orWhere(function ($quer) use ($wordsquery){
        //     foreach ($wordsquery as $word) {
        //         # code...
        //         $quer->orWhere('hawb', 'LIKE',"%$word%");
        //     }
        // })->get();

        dd($trackings);

        return view('tracking.busqueda',['trackings'=>$trackings]);
    }
}
