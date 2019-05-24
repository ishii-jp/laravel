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

    public function scopeWhereTweetId($query, $tweetId)
    {
        return $query->where('tweet_id', $tweetId);
    }

    public function scopeWhereUserId($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    static function likeCreate($tweetId, $userId, $like)
    {
        $like = Like::create(['tweet_id' => $tweetId, 'user_id' => $userId, 'like' => $like]);
        return $like;
    }

    static function likeDelete($user, $tweetId)
    {
        Like::whereUserId($user)->whereTweetId($tweetId)->delete();
    }

    static function likesCount($tweetId)
    {
        $likesCount = Like::whereTweetId($tweetId)->count();
        return $likesCount;
    }
}
