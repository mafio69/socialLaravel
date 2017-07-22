<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('post_permission', ['only' => ['edit','update','destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'post_content' => 'required|min:3',
        ]);
        Post::create([
            'content' => $request->post_content,
            'user_id' => auth()->id(),
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_admin()){
            $post = Post::findOrFail($id)->withTrashed();
        }else{
            $post = Post::findOrFail($id);
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(is_admin()){
            $post = Post::findOrFail($id)->withTrashed();
        }else{
            $post = Post::findOrFail($id);
        }
        return view('posts.edit',compact('post'));
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
        $this->validate($request, [
            'post_content' => 'required|min:3',
        ]);
       $post = Post::findOrFail($id);
       $post->content = $request->post_content;
       $post->save();
       return redirect('users/'.auth()->id());


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*$post = Post::withTrashed()
        ->where('id', $id)
        ->delete();*/
        if(is_admin()){
            $post= Post::find($id);
            $post->forceDelete();
            $post->comments()->forceDelete();
        }else{
            $post= Post::find($id);
            $post->delete();
            $post->comments()->delete();
        }

        return redirect('users/'.auth()->id());
    }
}
