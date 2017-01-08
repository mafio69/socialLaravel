<?php

namespace App\Http\Middleware;

use Closure;
use App\Post;

class CheckPostPermission
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
        $post_exist = Post::where('id', $request->post)->where('user_id',auth()->id())->exists();
      if((auth()->check() && $post_exist )|| is_admin()){
          return $next($request);
      } else {
          abort(403 , 'Brak dostępu');
      }
    }
}