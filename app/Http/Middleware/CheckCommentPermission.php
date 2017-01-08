<?php

namespace App\Http\Middleware;

use App\Comment;
use Closure;


class CheckCommentPermission
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
        $comment_exist = Comment::where('id', $request->comment)->where('user_id',auth()->id())->exists();
      if((auth()->check() && $comment_exist) || is_admin()){
          return $next($request);
      } else {
          abort(403 , 'Brak dostępu');
      }
    }
}