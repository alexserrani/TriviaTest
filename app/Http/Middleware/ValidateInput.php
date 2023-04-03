<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateInput
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
        $request->validate([
            'username' => 'required|unique:users|max:30|min:6',
            'password' => 'required|max:30|min:6',
            'password_confirmation' => 'required|same:password'
        ]);

        return $next($request);
    }
}
