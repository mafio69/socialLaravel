<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserPermission {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
//       echo Auth::id().$request->user;
//       exit();
        if (belongs_to_auth($request->user) ||is_admin()) {
            return $next($request);
        } else {
            abort(403, 'Brak dostepu');
        }
    }

}
