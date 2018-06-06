<?php

namespace App\Http\Middleware;

use Closure;

class AdminMiddleware
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
        //este middleware me permite verificar si un usuario es admin o no
        
        if(!auth()->user()->admin)
        {
            return redirect('/');
        
        }
        return $next($request);
  }

}
