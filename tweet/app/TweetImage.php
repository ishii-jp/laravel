<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TweetImage extends Model
{
    protected $fillable = ['tweet_id', 'image'];

    public function tweet()
    {
        return $this->belongsTo('App\tweet');
    }

    static function registImage($images, $tweetCreateReault)
    {
        foreach ($images as $image){
            $filename = $image->store('public/avatar');
            TweetImage::create(['tweet_id' => $tweetCreateReault->id, 'image' => basename($filename)]);
        }
    }

    static function updateImage($images, $tweetId)
    {
        foreach ($images as $image){
            $filename = $image->store('public/avatar');
            TweetImage::updateOrCreate(['tweet_id' => $tweetId],['image' => basename($filename)]);
        }
    }
}
