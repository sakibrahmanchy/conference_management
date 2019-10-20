<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Scope;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use PHPMailer\PHPMailer\PHPMailer;

class ConferenceController extends Controller
{


    public function CreateConferenceGet(){
        $conference = new Conference();
        return view("conference_create",["conference"=>$conference]);
    }


    public function CreateConferencePost(Request $request){

        $this->validate($request, [
            'title' => 'required|regex:/ /',
            'venue' => 'required',
            'conference_start_date' => 'required',
            'conference_end_date' => 'required',
            'paper_submission_deadline'=>'required'
        ]);

        $id = Conference::create($request->all())->id;

        $conference_url = strtolower(Conference::where("id",$id)->first()->title);
        $conference_url = str_replace(' ','_',$conference_url);
        $conference_url = $conference_url."_".$id;
        $user_id = Auth::user()->id;
        Conference::where("id",$id)->update(
           [
                "conference_url"=>$conference_url,
               "user_id" =>$user_id
           ]
        );

        return redirect()->route('get_conferences');
    }

    public function EditConferenceGet($conferenceId){

        $conferenceBasicInfos = Conference::where("id",$conferenceId)->first();

        return view("conference_edit_basic",["pageTitle"=>"basic","conference_id"=>$conferenceId,"conference"=>$conferenceBasicInfos]);

    }

    public function EditConferencePost($conferenceId, Request $request){

        $this->validate($request, [
            'title' => 'required|regex:/ /',

        ]);

        Conference::where("id",$conferenceId)->update($request->except(['_token']));

        $conference_url = strtolower(Conference::where("id",$conferenceId)->first()->title);
        $conference_url = str_replace(' ','_',$conference_url);
        $conference_url = $conference_url."_".$conferenceId;

        Conference::where("id",$conferenceId)->update(
           [
                "conference_url"=>$conference_url
           ]
        );

        $file = $request->file('logo');
        $filename = "conference-logo-".$conferenceId . '.jpg';

        //If retrieved image is a file
        if ($file) {
            $image = Image::make($file)->stream();
            Storage::disk('local')->put($filename, $image);
        }

        $file = $request->file('cover');
        $filename = "conference-cover-".$conferenceId . '.jpg';

        //If retrieved image is a file
        if ($file) {
            $image = Image::make($file)->stream();
            Storage::disk('local')->put($filename, $image);
        }


        return redirect()->route('edit_conference',["pageTitle"=>"basic","conference_id"=>$conferenceId]);

    }

    public function EditConferenceDatesGet($conferenceId){

        $conferenceBasicInfos = Conference::where("id",$conferenceId)->first();

        return view("conference_edit_dates",["pageTitle"=>"dates","conference_id"=>$conferenceId,"conference"=>$conferenceBasicInfos]);

    }

    public function EditConferenceDatesPost($conferenceId, Request $request){

        Conference::where("id",$conferenceId)->update($request->except(['_token']));

        return redirect()->route('edit_conference_dates',["pageTitle"=>"dates","conference_id"=>$conferenceId]);

    }

    public function EditConferenceTermsGet($conferenceId){

        $conferenceBasicInfos = Conference::where("id",$conferenceId)->first();

        return view("conference_edit_terms",["pageTitle"=>"terms","conference_id"=>$conferenceId,"conference"=>$conferenceBasicInfos]);

    }

    public function EditConferenceTermsPost($conferenceId, Request $request){

        Conference::where("id",$conferenceId)->update($request->except(['_token']));

        return redirect()->route('edit_conference_terms',["pageTitle"=>"terms","conference_id"=>$conferenceId]);

    }



    public function GetConferenceList(){
        $user_id = Auth::user()->id;
        $conferenceList = Conference::where("user_id",$user_id)->get();
        return view('conference_list',['conferenceList'=>$conferenceList]);

    }

    public function getConferenceHomePage($conference_url){
        $conference = Conference::where("conference_url",$conference_url)->with('speakers','user','tracks','committees')->first();
        if(!is_null($conference))
            return view('conference_dashboard',["conference"=>$conference]);
        else
            return view('errors.503');
    }

    public function getAllConferences(){
        $conferenceList = Conference::all();
          return view('all_conference_list',['conferenceList'=>$conferenceList]);
    }

    public function randomMail(){

        $user = new User();
        $user->mailUser("sakib.cse11.cuet@gmail.com","aassa","sassaa");
    }
}

