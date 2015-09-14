<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotMainAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     protected $auth;
     
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    
    public function handle($request, Closure $next)
    {
        if(!(Auth::check())){
            return redirect('/'); 
        }
        
        return $next($request);
    }
}
