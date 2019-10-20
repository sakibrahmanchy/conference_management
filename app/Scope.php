<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scope extends Model
{
    //
    protected $fillable=['track_id','name'];


    public function track(){
        return $this->belongsTo('App\Track');
    }

    public function files()
    {
        return $this->hasMany('App\File');
    }

}
