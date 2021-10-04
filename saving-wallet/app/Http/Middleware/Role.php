<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
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
        // Note:- User = 1 , admin = 2   (tiny integer with index for for speed retrieve data and better performance )
        if(auth()->user()->role == 1){
            return $next($request);
        }

        return redirect('admin/home')->with('error',"Only User can access !");
    }
}
