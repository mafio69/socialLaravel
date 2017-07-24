<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;
use App\User;

class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = User::find(auth()->id());
        return view('Notification.index',compact('user'));
    }

    public function update($id)
    {
        DatabaseNotification::where([
            'id' => $id,
            'notifiable_id' => Auth::id(),
        ])->firstOrFail()->markAsRead();

        return back();

    }
}
