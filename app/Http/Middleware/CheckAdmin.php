<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckAdmin
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
       $admin_id =Session::get('admin_id');
       if ($admin_id) {
           return $next($request);
       }

        else
        {
            return redirect('/admin');
        }
    }
}
