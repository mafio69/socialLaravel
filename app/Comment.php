<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Soft delete to musi być

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'content', 'post_id',
    ];
    use SoftDeletes; // ten wpis też musi być
    protected $dates = ['deleted_at']; // To też soft delete

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
