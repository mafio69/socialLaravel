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
        return $this->belongsTo('App\User')->orderBy('created_at','desc');
    }

}
