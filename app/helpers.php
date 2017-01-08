<?php

use App\Friend;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function friendship($friend_id)
{
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

function has_friend($friend_id)
{
    return Friend::where([
        'user_id' => $friend_id,
        'friend_id' => auth()->id(),
        'accepted' => 0,
    ])->exists();
}

function belongs_to_auth($user_id)
{
    return (auth()->check() && auth()->id() === $user_id);
}

function is_admin()
{
    return (auth()->check() && Auth::user()->role->type === 'admin');
}

function czas($data)
{

    $marker = time() - (strtotime($data));
    $time_stamp = $marker;

    // zmienne pomocne przy obliczeniach (dlugość w sekundach)
    $tydzien = 7 * 24 * 60 * 60;
    $dzien = 24 * 60 * 60;
    $godzina = 60 * 60;
    $minuta = 60;

    if ((floor($marker / $tydzien) >= 1)) {

        $t = floor($marker / $tydzien);
        $marker = $marker - ($t * $tydzien);
    } else $t = 0;

    if ((floor($marker / $dzien) >= 1)) {
        $d = floor($marker / $dzien);
        $marker = $marker - ($d * $dzien);
    } else $d = 0;
    if ((floor($marker / $godzina) >= 1)) {
        $g = floor($marker / $godzina);
        $marker = $marker - ($g * $godzina);
    } else $g = 0;
    if ((floor($marker / $minuta) >= 1)) {
        $m = floor($marker / $minuta);
        
    } else $m = 0;

    if ($time_stamp < 60) {
        return 'Wpis dodano przed minutą';
    } elseif ($t < 1 && $d > 0) {
        return  $d ." dni, ". $g .  " godzin, " . $m. " minut. " ;
    } elseif ($t < 1 && $d < 1 && $g > 0) {
        return  $g . "  godzin, " . $m." minut." ;
    } elseif ($t < 1 && $d < 1 && $g < 1 && $m > 0) {
        return  $m ."  minut. " ;
    } elseif ($t > 1 && $t < 2) {
        return  $t . " tygodni, " . $d . " dni, " . $g . " godzin " . $m . " minut .";
    } else {
        //return $time_stamp . '-' . $t . '-' . $d;
        return 'Więcej niż dwa tygodnie.';
    }
}