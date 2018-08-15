<?php

namespace App\Http\Controllers\Tracking;
use App\Tracking;
use App\StatusTracking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusTrackingController extends Controller
{
     public function store(Request $request)
    {

        
        $statustracking=StatusTracking::create($request->all());
        
        return redirect('tracking')->with(['feedback'   => 'El status: "'.$statustracking->status.'" a sido agregado con exito al tracking hawb: '.$statustracking->tracking->hawb,'alert_type' => 'alert-success']);
    }
}
