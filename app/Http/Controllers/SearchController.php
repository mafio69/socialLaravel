<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\User;

class SearchController extends Controller {

    public function users() {
        $query = Input::get('q');
        $users = User::where('name', 'LIKE', '%' . $query . '%')->orWhere('email', 'LIKE', '%' . $query . '%')->paginate(6);

        return view('search.users', compact('users', 'query'));
    }

}
