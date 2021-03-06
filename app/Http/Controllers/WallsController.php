<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;


class WallsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {

        if (auth()->check()) {
            $user = User::find(auth()->id());
            $friends = User::FindOrFail(auth()->id())->friends();
            $collect_user_ids[] = auth()->id();

            foreach ($friends as $friend) {
                $collect_user_ids[] = $friend->id; // Tu wybieram przyjaciół i zapisuje w tablicy kolekcji
            }
        } else {
            foreach (User::all() as $user) {
                $collect_user_ids[] = $user->id; // Tu wybieram przyjaciół i zapisuje w tablicy kolekcji
            }

        }
        if (is_admin()) {
            $posts = Post::with('comments.user')
                ->with('likes')
                ->with('user')// with to pobiera dane by potem na stronie nie odpytywać bazy danych\
                ->withTrashed()
                ->whereIn('user_id', $collect_user_ids)// whereIn można zastosować tablicę jako argument
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        } else {
            $posts = Post::with('comments.user')
                ->with('likes')
                ->with('user')// with to pobiera dane by potem na stronie nie odpytywać bazy danych
                ->whereIn('user_id', $collect_user_ids)// whereIn można zastosować tablicę jako argument
                ->orderBy('created_at', 'desc')
                ->paginate(20);
        }

        return view('walls.index', compact('posts', 'user'));
    }
}
