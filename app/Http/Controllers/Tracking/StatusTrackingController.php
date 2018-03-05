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
        
        return redirect('tracking');
    }
}
