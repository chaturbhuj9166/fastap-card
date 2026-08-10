<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request; 

class Allreadylogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    
    {

 if(session()->has('admin')&& (url('admin')==$request->url() ||url('adminlogin')==$request->url() )){

     return back();
 }

        return $next($request);
    }
}
