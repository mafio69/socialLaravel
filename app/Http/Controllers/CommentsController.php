<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('comment_permission', ['except' => ['store']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post_id_comment_content = 'post_' . $request->post_id .'_comment_content';
        $post_comment = $request->$post_id_comment_content;


        $this->validate($request, [
            $post_id_comment_content => 'required|min:5',
            'post_id' => 'numeric',
        ], [
            'numeric' => 'Próba ingerencji w formularz',
            'required' => 'Musisz wpisać jakąś treść',
            'min' => 'Treść musi mieć minimum :min znaków',
        ]);

        Comment::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
            'content' =>   $post_comment,
        ]);

        return back();
    }
    // Wysyła formularz edycji
    public function edit($id)
    {

        $comment = Comment::findOrFail($id);
       return view('comments.edit', compact('comment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);
        $comment->content = $request->comment_content;
        $comment->save();
        return redirect('/wall');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::withTrashed()
            ->where('id', $id)
            ->delete();
        return redirect('/wall');
    }
}
