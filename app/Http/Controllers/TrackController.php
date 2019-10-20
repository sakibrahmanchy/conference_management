<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Track;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests;

class TrackController extends Controller
{
      public function CreateTrackGet($conference_id){

        return view("track_create",["pageTitle"=>"track",'conference_id'=>$conference_id]);

    }


    public function CreateTrackPost(Request $request, $conference_id){

        $this->validate($request, [
            'track_name' => 'required',
        ]);

        $conference = Conference::where("id",$conference_id)->first();

        $track = new Track();
        $id = $conference->tracks()->create($request->all())->id;
        $file = $request->file('image');
        $filename = "track-".$id . '.jpg'; //Filename as the name of the user

        //If retrieved image is a file
        if ($file) {
            $image = Image::make($file)->stream(); //Resizing image using Intervention Image
            Storage::disk('local')->put($filename, $image);  // Storing image in the disk as the name according to user id
        }

        return redirect()->route('track_list',["pageTitle"=>"track",'conference_id'=>$conference_id]);
    }

    public function EditTrackGet($conference_id,$trackId){

        $trackBasicInfos = Track::where("id",$trackId)->first();

        return view("track_edit",["pageTitle"=>"track","conference_id"=>$conference_id,"track"=>$trackBasicInfos]);

    }

    public function EditTrackPost($conference_id , $trackId, Request $request){

        Track::where("id",$trackId)->update($request->except(['_token']));

        $id = $trackId;

        $file = $request->file('image');
        $filename = "track-".$id . '.jpg'; //Filename as the name of the user

        //If retrieved image is a file
        if ($file) {
            $image = Image::make($file)->stream(); //Resizing image using Intervention Image
            Storage::disk('local')->put($filename, $image);  // Storing image in the disk as the name according to user id
        }

          return redirect()->route('track_list',["conference_id"=>$conference_id]);

    }

    public function GetTrackList($conference_id){


        $trackList = Track::where("conference_id",$conference_id)->with('scopes')->get();
        return view('track_list',["pageTitle"=>"track",'conference_id'=>$conference_id,'trackList'=>$trackList]);

    }

    public function DeleteTrack($conference_id,$track_id){

        $track = Track::where("id",$track_id)->first();
        $track->delete();

        return redirect()->route('track_list',["conference_id"=>$conference_id]);
    }


    public function getTrackImage($conference_id,$filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

}
