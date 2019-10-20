<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    //
    protected $fillable = ['title','venue','paper_submission_deadline',
            'notification_of_acceptance_date',
            'camera_ready_paper_date',
            'registration_deadline',
            'conference_start_date',
            'conference_end_date',
            'poster',
            'conference_url',
            'submission_guideline',
            'plagiarism_policy',
            'review_policy',
            'best_paper_award',
            'description',
            'cover',
            'logo'];

    public function users(){
        return $this->belongsToMany('App\User');
    }
    
    public function speakers(){
        return $this->hasMany('App\Speaker');
    }

     public function tracks(){
        return $this->hasMany('App\Track');
     }

    public function committees(){
        return $this->hasMany('App\Committee');
     }

    public function user(){
        return $this->belongsTo('App\User');
    }


}
