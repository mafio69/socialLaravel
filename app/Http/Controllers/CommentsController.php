<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\PostCommented;
use App\Post;
use App\User;
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post_id_comment_content = 'post_' . $request->post_id . '_comment_content';
        $post_comment = $request->$post_id_comment_content;


        $this->validate($request, [
            $post_id_comment_content => 'required|min:5',
            'post_id' => 'numeric',
        ], [
            'numeric' => 'Próba ingerencji w formularz',
            'required' => 'Musisz wpisać jakąś treść',
            'min' => 'Treść musi mieć minimum :min znaków',
        ]);

        $comment = Comment::create([
            'post_id' => $request->post_id,
            'user_id' => auth()->id(),
            'content' => $post_comment,
        ]);
        $post = Post::findOrFail($request->post_id);

        var_dump($post);
        //$user = User::findOrFail('id',$post->user_id);
        //var_dump($user);
        if ($post->user_id !=auth()->id()) {
            User::findOrFail($post->user_id)->notify(new PostCommented($request->post_id, $comment->id));
        }

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
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_admin()) {
            Comment::where('id', $id)
                ->forceDelete();
        } else {
            Comment::withTrashed()
                ->where('id', $id)
                ->delete();
        }

        return redirect('/wall');
    }
}
