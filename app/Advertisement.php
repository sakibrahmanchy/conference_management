<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use \Illuminate\Auth\Authenticatable;
    public function allotment(){
        return $this->belongsTo('App\Allotment');
    }

    public function requests()
    {
        return $this->hasMany('App\UserRequest');
    }
}
