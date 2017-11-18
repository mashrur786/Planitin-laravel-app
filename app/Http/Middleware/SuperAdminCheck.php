<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class SuperAdminCheck
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

       if($request->user()->role != "administrator"){
             Session::flash('error', 'Stop! you don\'t have permission to access this area');
             return redirect()->route('admin.dashboard');
       }
        return $next($request);
    }
}
