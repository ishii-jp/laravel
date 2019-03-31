<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = array('title', 'text', 'user_id', 'tweet_id');

    public function tweet()
    {
        return $this->belongsTo('app\Tweet');
    }

    public function user()
    {
        return $this->belongsTo('app\User');
    }

}
