<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function scope(){
        return $this->belongsTo('App\Scope');
    }

    public function reviews(){
        return $this->hasOne('App\Review');
    }
}
