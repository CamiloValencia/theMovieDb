<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        $origin = filter_input(INPUT_SERVER, 'HTTP_ORIGIN');
        return $next($request)
                        ->header('Access-Control-Allow-Origin', $origin)
                        ->header('Access-Control-Allow-Methods', 'PUT, POST, DELETE')
                        ->header('Access-Control-Allow-Headers', 'Accept, Content-Type,X-CSRF-TOKEN')
                        ->header('Access-Control-Allow-Credentials', 'true');
    }

}
