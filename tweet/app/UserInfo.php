<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'user_infos';

    protected $fillable = array('user_id', 'name', 'email', 'year', 'month', 'day', 'profile','blood_type', 'hobby', 'residence', 'avatar_filename');


    static function registUserInfo($values)
    {
        UserInfo::updateOrCreate([
            'user_id' => $values['user_id'],
            'name' => $values['name'],
            'email' => $values['email']
        ],[
            'year' => $values['year'],
            'month' => $values['month'],
            'day' => $values['day'],
            'profile' => $values['profile'],
            'blood_type' => $values['blood_type'],
            'hobby' => $values['hobby'],
            'residence' => $values['residence'],
        ]);
    }
}

