<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    protected $fillable = array('title', 'image', 'text','user_id');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tweetImages()
    {
        return $this->hasMany('App\TweetImage');
    }

    public function replies()
    {
        return $this->hasMany('App\Reply');
    }
}
