<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Frontend\HelperFront;
use Closure;

class AuthCart
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->guard('customer')->user()) {
            $title = 'No has iniciado sesión';
            $message = 'Por favor inicia sesión para entrar en esta sección.';

            if(request()->ajax()){
                return HelperFront::responseJson(401, 'Usuario no autenticado.', null);
            }else{
                return response()->view('frontend.globals.refuted', compact('title', 'message'));
            }
        }
        return $next($request);
    }
}
