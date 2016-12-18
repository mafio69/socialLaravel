<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Friend;
use App\User;

class FriendsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user_id)
    {
        $friends = User::FindOrFail($user_id)->friends();
        $user = User::FindOrFail($user_id);
        return view('friends.index', compact('friends','user'));
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add($friend_id)
    {
        //
        if (!friendship($friend_id)->exists && !friendship($friend_id)->accepted){
        Friend::create(['user_id'=> Auth::id(),'friend_id'=>$friend_id]);
        return back();
    }else{
    $this->accept($friend_id);
    }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function accept($friend_id)
    {
        Friend::where([
            'friend_id' => auth()->id(),
            'user_id' => $friend_id,
        ])->update(['accepted' => 1]);
        return back();
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($friend_id)
    {
       Friend::where([
                'user_id' => auth()->id(),
                'friend_id' => $friend_id,
            ])->orWhere([
                'user_id' => $friend_id,
                'friend_id' => auth()->id(),
            ])->delete();
            return back();
    }
}
