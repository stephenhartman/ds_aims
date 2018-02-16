<?php

namespace App\Http\Middleware;

use Closure;
use Jrean\UserVerification\Exceptions\UserNotVerifiedException;

class IsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws UserNotVerifiedException
     */
    public function handle($request, Closure $next)
    {
        if(! is_null($request->user()) && ! $request->user()->verified) {
            throw new UserNotVerifiedException;
            return response()->view('auth.errors.not-verified', [], 401); //  <----- The magic
        }
        return $next($request);
    }
}
