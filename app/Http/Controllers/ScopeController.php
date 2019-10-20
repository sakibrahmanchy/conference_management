<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Scope;
use App\Track;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests;

class ScopeController extends Controller
{
      public function CreateScopeGet($conference_id){

        $trackList = Track::where("conference_id",$conference_id)->get();

        return view("scope_create",["tracks"=>$trackList, "pageTitle"=>"scope",'conference_id'=>$conference_id]);

    }


    public function CreateScopePost(Request $request, $conference_id){

        $this->validate($request, [
            'name' => 'required',
            'track_id' => 'required'
        ]);

        $track_id = $request['track_id'];

        $track = Track::where("id",$track_id)->first();

        $id = $track->scopes()->create($request->all())->id;

        return redirect()->route('track_list',["pageTitle"=>"track",'conference_id'=>$conference_id]);
    }

    public function EditScopeGet($conference_id,$scopeId){

        $scopeBasicInfos = Scope::where("id",$scopeId)->first();

        $trackList = Track::where("conference_id",$conference_id)->get();

        return view("scope_edit",["tracks"=>$trackList,"pageTitle"=>"track","conference_id"=>$conference_id,"scope"=>$scopeBasicInfos]);


    }

    public function EditScopePost($conference_id , $scopeId, Request $request){

        Scope::where("id",$scopeId)->update($request->except(['_token']));

          return redirect()->route('track_list',["conference_id"=>$conference_id]);

    }

    public function GetScopeList($conference_id){


        $scopeList = Scope::where("conference_id",$conference_id)->get();
        return view('scope_list',["pageTitle"=>"track",'conference_id'=>$conference_id,'scopeList'=>$scopeList]);

    }

    public function DeleteScope($conference_id,$scope_id){

        $scope = Scope::where("id",$scope_id)->first();
        $scope->delete();

        return redirect()->route('track_list',["conference_id"],$conference_id);
    }
}
