<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use \Illuminate\Auth\Authenticatable;
    public function user(){
        return $this->belongs('App\User');
    }

}
