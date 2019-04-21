<?php

namespace App\Http\Middleware;

use Closure;
use Seesion;

class CheckLogin
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
        if ($request->session()->get('currentUser') == null){
            return redirect('login')->with('error', 'Bạn cần đăng nhập để sử dụng chức năng này');
        }
        return $next($request);
    }
}
