<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = array('tweet_id', 'user_id', 'like');

    public function tweet(){
        return $this->belongsTo(Tweet::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
