<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('user_permission', ['except' => ['show']]);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {

        $user = User::findOrFail($id);
        //$posts = $user->posts()->paginate(10);
        if (is_admin()) {
            $posts = Post::with('comments.user','likes')
                ->withTrashed()
                ->where('user_id', $id)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } else {

            $posts = Post::with('comments.user','likes')
                ->where('user_id', $id)
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }
        return view('users.show', compact('user', 'posts'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     *
     *
     */
    public function update(Request $request, $id)
    {
        //echo

        $this->validate($request, [
            'name' => 'required|max:255|min:3',
            'sex' => 'required',
            'avatar' => 'required|mimes:jpeg,bmp,png,jpg',
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($id)],
        ]);
        $user = User::findOrFail($id);
        if ($request->file('avatar')) {
            $user_avatar_path =  'storage'.DIRECTORY_SEPARATOR.'users'.DIRECTORY_SEPARATOR . $id .DIRECTORY_SEPARATOR.'avatars'.DIRECTORY_SEPARATOR;
            Storage::makeDirectory('public/users/' . $id . '/avatars/',755);
            $extension = $request->file('avatar')->extension();
            $avatar_filename = 'avatar' . $id . '.' . $extension;
            Image::make($request->file('avatar'))->fit(400)->save($user_avatar_path.$avatar_filename,80);
        }

        $user->avatar = $avatar_filename;
        $user->email = $request->email;
        $user->sex = $request->sex;
        $user->name = $request->name;
        $user->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
