<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check()) {
            $role = $this->auth->user()->role_id;
            switch($role){
                case 1:
                    return redirect('main-admin/');
                    break;
                case 2:
                    return redirect('institution/');
                    break;
                case 3:
                    return redirect('professor/');
                    break;
                case 4:
                    return redirect('student/');
                    break;
                default:
                    return 'Woops';
            }
            
        }

        return $next($request);
    }
}
