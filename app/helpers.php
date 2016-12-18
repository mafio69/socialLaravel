<?php

use App\Friend;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function friendship($friend_id) {
    $friend_query = Friend::where([
                'user_id' => auth()->id(),
                'friend_id' => $friend_id,
            ])->orWhere([
                'user_id' => $friend_id,
                'friend_id' => auth()->id(),
            ])->first();
    $friendship = new stdClass();

    if (empty($friend_query)) {
        $friendship->exists = FALSE;
        $friendship->accepted = FALSE;
    } else {
        $friendship->exists = TRUE;
        $friendship->accepted = $friend_query->accepted;
    }
    return $friendship;
}

function has_friend($friend_id) {
    return Friend::where([
                'user_id' => $friend_id,
                'friend_id' => auth()->id(),
                'accepted' => 0,
            ])->exists();
}
