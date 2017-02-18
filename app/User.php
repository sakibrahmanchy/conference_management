<?php

namespace App;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    //
    public function allotment()
    {
        return $this->hasOne('App\Allotment');
    }

    public function uRequest()
    {
        return $this->hasOne('App\UserRequest');
    }
}
