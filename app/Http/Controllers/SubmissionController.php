<?php

namespace App\Http\Controllers;

use App\Conference;
use App\Scope;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{


    public function SubmissionWelcomeGet($conference_id){

        if(Auth::check())
            return redirect()->route('submissions_get',["conference_id"=>$conference_id]);
        return view('user_welcome',["conference_id"=>$conference_id]);
    }

    public function SubmissionSignUpGet($conference_id){

        if(Auth::check())
            return redirect()->route('submissions_get',["conference_id"=>$conference_id]);
        return view('user_signup',["conference_id"=>$conference_id]);
    }


    public  function SubmitSignUp(Request $request, $conference_id){

        $this->validate($request, [
            'email' => 'required|unique:users|email',
            'name' => 'required',
            'password' => 'required|min:6',
            'description' => 'required',
            'phone' =>'required|numeric|digits:11'
        ]);

        $conference = Conference::where("id",$conference_id)->first();

        $id = $conference->users()->create($request->all())->id;
        User::where("id",$id)->update(["user_type"=>3,"password"=>bcrypt($request['password']),"status"=>1]);

        return redirect()->route('submit_welcome',["conference_id"=>$conference_id]);
    }

    public function SubmitDashBoard( $conference_id){
        return view('user_dashboard',["conference_id",$conference_id]);
    }

    public function getAccount($conference_id)
    {
        return view('account', ['user' => Auth::user()]);
    }

    public function GetSubmitFiles($conference_id){

        $scopes =  DB::table("tracks")
                ->join("scopes","tracks.id",'=',"scopes.track_id")->where("conference_id",$conference_id)->get();

           return view('user_submit_files',["conference_id"=>$conference_id,"scopes"=>$scopes]);
    }

    public function PostSubmitFiles(Request $request, $conference_id){
        $this->validate($request, [
            "scope"=>"required",
            "file" => "required|mimes:pdf|max:10000",
            "paper_title"=>'required'
        ]);


        $scope_id = $request->scope;

        $file = $request->file;
        $user = Auth::user();
        $fileExists = \App\File::where("user_id",$user->id)->where("scope_id",$scope_id)->first();
        if(!is_null($fileExists)){
            return redirect()->back()->withErrors('Sorry! You already have one paper in this scope');
        }
        $file_name = "user_".$user->id."_scope_".$scope_id.".pdf";
       /* if(Storage::disk('local')->has($file_name)){
            return redirect()->back()->withErrors("Sorry. You already have one paper in this track");
        }
        */
        Storage::disk('local')->put($file_name, File::get($file));
        $scope = Scope::where("id",$scope_id)->first();
        $fileData = new \App\File();
        $fileData->paper_title = $request->paper_title;
        $fileData->paper_abstract=$request->paper_abstract;
        $fileData->file_name =  $file_name;
        $fileData->user_id = $user->id;
        $fileData->scope_id = $scope_id;
        $fileData->save();
        $scope->files()->save($fileData);
        return redirect()->route('submissions_get',["conference_id"=>$conference_id]);
    }


    public function GetSubmissions($conference_id){

        $user= Auth::user();
          $scopes = (array) DB::table("tracks")
                ->leftJoin("scopes","tracks.id",'=',"scopes.track_id")->where("conference_id",$conference_id)->select('scopes.id')->get();
        $scopeList = [];
        foreach($scopes as $aScope){
          array_push($scopeList,$aScope->id);
        }
        $files = \App\File::whereIn("scope_id",$scopeList)->where("user_id",$user->id)->get();
        return view('user_submissions',["conference_id"=>$conference_id,"files"=>$files]);

    }

    public function EditAbstract(Request $request, $conference_id,$submission_id){

        $fileData = \App\File::where("id",$submission_id)->first();

        $fileData->paper_abstract = $request->paper_abstract;
        $fileData->save();
    }

    public function downloadFile($conference_id,$filename)
    {
        $file = Storage::disk('local')->get($filename);
        return response()->download(storage_path('app') . '/' . $filename);
    }

    public function JudgeSubmissions($conference_id){

        $files = DB::table("files")
                ->join("reviews","reviews.file_id",'=',"files.id")
                ->join("scopes","scopes.id",'=',"files.scope_id")
                ->join('tracks','tracks.id','=','scopes.track_id')
                ->join('users','reviews.reviewer_id','=','users.id')
                ->select('users.name as reviewer_name','files.id as file_unique_id','files.*','scopes.*','tracks.*','reviews.*')
                ->where("tracks.conference_id",$conference_id)->get();


        return view('user_judge',["pageTitle"=>"reviews","conference_id"=>$conference_id,"files"=>$files]);

    }

    public function ShowSubmissions($conference_id){

        $files = DB::table("files")
                ->leftJoin("reviews","reviews.file_id",'=',"files.id")
                ->join("scopes","scopes.id",'=',"files.scope_id")
                ->join('tracks','tracks.id','=','scopes.track_id')
                ->leftJoin('users','reviews.reviewer_id','=','users.id')
                ->select('users.name as reviewer_name','files.id as file_unique_id','files.*','scopes.*','tracks.*','reviews.*',DB::raw('avg(reviews.score) as average'))
                ->where("tracks.conference_id",$conference_id)->groupBy('files.id')->get();


        return view('user_submissions_count',["pageTitle"=>"submissions","conference_id"=>$conference_id,"files"=>$files]);

    }

    public function AcceptSubmission($conference_id, $submission_id){

        $file = \App\File::where("id",$submission_id)->first();
        $file->status = 2;
        $file->save();

        $user = User::where("id",$file->user_id)->first();
        $mailTo = $user->email;
        $subject = "Paper Accepted";
        $message = "Dear ".$user->name.",<br> Congratulations. Your paper(Title :".$file->paper_title.") has been accepted.<br> Regards,<br> Conf-Master Team";

        $user = new User();
        $user->mailUser($mailTo,$subject,$message);

        return redirect()->route('submissions_show',["conference_id"=>$conference_id]);
    }

    public function RejectSubmission($conference_id, $submission_id){

        $file = \App\File::where("id",$submission_id)->first();
        $file->status = 3;
        $file->save();

        $user = User::where("id",$file->user_id)->first();
        $mailTo = $user->email;
        $subject = "Paper Rejected";
        $message = "Dear ".$user->name.",<br> Sorry. Your paper(Title :".$file->paper_title.") has been rejected. Better luck next time.<br> Regards,<br> Conf-Master Team";

        $user = new User();
        $user->mailUser($mailTo,$subject,$message);

        return redirect()->route('submissions_show',["conference_id"=>$conference_id]);
    }
}
