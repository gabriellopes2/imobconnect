<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckVendedor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()){
            return redirect()->route('login');
        }      
        $user = auth()->user();
        if ($user->pessoa->isproprietario == false)
        {
            return redirect()->route('/');
        } 
        return $next($request);
    }
}
