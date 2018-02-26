<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class PromoChk
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

         if (!Auth::check() || Auth::user()->rol != 'admin') {

            return redirect('/promovisita');

        }else{
            return redirect('/promotions');
        }

        //return $next($request);
    }
}
