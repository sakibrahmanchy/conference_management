<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Speaker;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests;

class SpeakerController extends Controller
{
      public function CreateSpeakerGet($conference_id){

        return view("speaker_create",["pageTitle"=>"speaker",'conference_id'=>$conference_id]);

    }


    public function CreateSpeakerPost(Request $request, $conference_id){

        $this->validate($request, [
            'name' => 'required',
        ]);

        $conference = Conference::where("id",$conference_id)->first();

        $speaker = new Speaker();
        $id = $conference->speakers()->create($request->all())->id;
        $file = $request->file('image');
        $filename = "speaker-".$id . '.jpg'; //Filename as the name of the user

        //If retrieved image is a file
        if ($file) {
            $image = Image::make($file)->stream(); //Resizing image using Intervention Image
            Storage::disk('local')->put($filename, $image);  // Storing image in the disk as the name according to user id
        }

        return redirect()->route('speaker_list',["pageTitle"=>"speaker",'conference_id'=>$conference_id]);
    }

    public function EditSpeakerGet($conference_id,$speakerId){

        $speakerBasicInfos = Speaker::where("id",$speakerId)->first();

        return view("speaker_edit",["pageTitle"=>"speaker","conference_id"=>$conference_id,"speaker"=>$speakerBasicInfos]);

    }

    public function EditSpeakerPost($conference_id , $speakerId, Request $request){

        Speaker::where("id",$speakerId)->update($request->except(['_token']));

        $id = $speakerId;

        $file = $request->file('image');
        $filename = "speaker-".$id . '.jpg'; //Filename as the name of the user

        //If retrieved image is a file
        if ($file) {
            $image = Image::make($file)->stream(); //Resizing image using Intervention Image
            Storage::disk('local')->put($filename, $image);  // Storing image in the disk as the name according to user id
        }

          return redirect()->route('speaker_list',["conference_id"=>$conference_id]);

    }

    public function GetSpeakerList($conference_id){


        $speakerList = Speaker::where("conference_id",$conference_id)->get();
        return view('speaker_list',["pageTitle"=>"speaker",'conference_id'=>$conference_id,'speakerList'=>$speakerList]);

    }

    public function DeleteSpeaker($conference_id,$speaker_id){

        $speaker = Speaker::where("id",$speaker_id)->first();
        $speaker->delete();

        return redirect()->route('speaker_list',["conference_id"=>$conference_id]);
    }


    public function getSpeakerImage($conference_id,$filename)
    {


        //Image resizing using Intervention Image
        /* $image = Image::make( Storage::disk('local')->get($filename) )->resize(250,250)->stream();

         Storage::disk('local')->put($filename, $image);*/

        //Retrieving image from storage
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

}
