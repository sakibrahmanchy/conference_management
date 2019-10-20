<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    protected $fillable= ['name','description'];



    public function conference(){
        return $this->belongsTo('App\Conference');
    }
}
