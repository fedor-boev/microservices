<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

//    /**
//     * Handle an incoming request.
//     * If JWT cookie isset, using auth with cookie
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \Closure  $next
//     * @param  string[]  ...$guards
//     * @return mixed
//     *
//     * @throws \Illuminate\Auth\AuthenticationException
//     */
//    public function handle($request, \Closure $next, ...$guards): mixed
//    {
//        if ($jwt = $request->cookie('jwt')) {
//            $request->headers->set('Authorization', 'Bearer '. $jwt);
//        }
//
//        $this->authenticate($request, $guards);
//
//        return $next($request);
//    }
}
