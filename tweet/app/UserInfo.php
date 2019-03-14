<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'user_infos';

    protected $fillable = array('user_id', 'name', 'email', 'year', 'month', 'day', 'profile','blood_type', 'hobby', 'residence', 'avatar_filename');
}
