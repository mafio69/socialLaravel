<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{

    protected $fillable = [
        'user_id', 'content',
    ];
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comments(){
        if(is_admin()){
            return $this->hasMany('App\Comment')->orderBy('created_at','desc')->withTrashed();
        }else{
            return $this->hasMany('App\Comment')->orderBy('created_at','desc');
        }

    }

    public function likes()
    {
        return $this->hasMany('App\Like');
    }
}
