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
}
