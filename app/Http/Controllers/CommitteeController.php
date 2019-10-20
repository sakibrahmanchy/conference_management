<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Committee;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests;

class CommitteeController extends Controller
{
      public function CreateCommitteeGet($conference_id){

        return view("committee_create",["pageTitle"=>"committee",'conference_id'=>$conference_id]);

    }


    public function CreateCommitteePost(Request $request, $conference_id){

        $this->validate($request, [
            'name' => 'required',
        ]);

        $conference = Conference::where("id",$conference_id)->first();

        $committee = new Committee();
        $id = $conference->committees()->create($request->all())->id;

        return redirect()->route('committee_list',["pageTitle"=>"committee",'conference_id'=>$conference_id]);
    }

    public function EditCommitteeGet($conference_id,$committeeId){

        $committeeBasicInfos = Committee::where("id",$committeeId)->first();

        return view("committee_edit",["pageTitle"=>"committee","conference_id"=>$conference_id,"committee"=>$committeeBasicInfos]);

    }

    public function EditCommitteePost($conference_id , $committeeId, Request $request){

        Committee::where("id",$committeeId)->update($request->except(['_token']));

          return redirect()->route('committee_list',["conference_id"=>$conference_id]);

    }

    public function GetCommitteeList($conference_id){


        $committeeList = Committee::where("conference_id",$conference_id)->get();
        return view('committee_list',["pageTitle"=>"committee",'conference_id'=>$conference_id,'committeeList'=>$committeeList]);

    }

    public function DeleteCommittee($committee_id){

        $committee = Committee::where("id",$committee_id)->first();
        $committee->delete();

        return redirect()->route('committee_list');
    }




}
