<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Allotment extends Model
{
    use \Illuminate\Auth\Authenticatable;
    //
    public function User(){
        return $this->belongsTo('App\User');
    }

    public function advertisement(){
        return $this->hasOne('App\Advertisement');
    }
}
