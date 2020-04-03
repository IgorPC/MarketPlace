<?php

namespace App\Http\Middleware;

use Closure;

class UsuarioTemLojaMiddleware
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
        if(auth()->user()->loja()->count()){
            $request->session()->flash('mensagem', 'Você ja possui uma loja cadastrada');
            return redirect()->route('lojas.index');
        }

        return $next($request);
    }
}
