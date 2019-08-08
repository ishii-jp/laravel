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

    public function likes(){
        return $this->hasMany(Like::class);
    }

    static function likesRanking()
    {
        $likesCount = self::with(['likes', 'user'])->withCount('likes')->orderBy('likes_count', 'DESC')->limit(5)->get();
        return $likesCount;
    }

    static function tweetSearch($function ,$text)
    {
        $result = self::with(['user', 'tweetImages', 'replies', 'likes' => $function])->where('text', 'like', "%{$text}%")->orderBy('updated_at', 'DESC')->withCount('likes')->paginate(10);
        return $result;
    }
}
