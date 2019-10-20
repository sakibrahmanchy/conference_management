<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    //

    protected $fillable= ['track_name', 'image', 'description',];



    public function scopes(){
        return $this->hasMany('App\Scope');
    }

    public function conference(){
        return $this->belongsTo('App\Conference');
    }
}
