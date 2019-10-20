<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{
    public function conference(){
        return $this->belongsTo('App\Conference');
    }

    protected $fillable = ['name',
            'profession',
            'institute',
            'address',
            'email',
            'biography',
            'image'];
    

}
