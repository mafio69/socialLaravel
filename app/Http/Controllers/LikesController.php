<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function add(Request $request)
    {
        $like = new Like;
        $like->user_id = auth()->id();
        if ($request->post_id) {
            $like->post_id = $request->post_id;
        }
        if ($request->comment_id) {
            $like->comment_id = $request->comment_id;
        }
        $like->save();
        return redirect('/wall');
       /* if ((Like::where(['user_id' => auth()->id(), 'post_id' => $request->post_id])->exists())) {
            Like::where(['user_id' => auth()->id(), 'post_id' => $request->post_id])->delete();
            return redirect('/wall');
        } elseif ((Like::where(['user_id' => auth()->id(), 'comment_id' => $request->comment_id])->exists())) {
            Like::where(['user_id' => auth()->id(), 'comment_id' => $request->comment_id])->delete();
            return redirect('/wall');
        } else {
            $like->save();
            return redirect('/wall');
        }*/
    }

    public function destroy()
    {

    }
}
