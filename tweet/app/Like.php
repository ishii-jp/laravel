<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = array('tweet_id','like');

    public function tweet(){
        return $this->belongsTo(Tweet::class);
    }
}
