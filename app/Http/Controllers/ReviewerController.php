<?php

namespace App\Http\Controllers;

use App\Conference;
use App\File;
use App\Review;
use App\Scope;
use App\Track;
use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use App\Http\Requests;

class ReviewerController extends Controller
{
      public function CreateReviewerGet($conference_id){

        $scopes = DB::table('scopes')
                  ->join('tracks','scopes.track_id','=','tracks.id')
                  ->where('tracks.conference_id','=',$conference_id)->select('tracks.*','scopes.*','scopes.id as scope_id')->get();
				  
			  

        return view("reviewer_create",["scopes"=>$scopes,"pageTitle"=>"reviewer",'conference_id'=>$conference_id]);

    }


    public function CreateReviewerPost(Request $request, $conference_id){

        $this->validate($request, [
            'name' => 'required',
            'password' => 'required|min:6',
            'email' => 'required|unique:users|email',
            'scope_id'=>'required'
        ]);

        $conference = Conference::where("id",$conference_id)->first();

        $id = $conference->users()->create($request->all())->id;
		
		
        DB::table('reviewer_scope')->insert(
            array(
                'user_id'=>$id,
                'scope_id'=>$request->scope_id
            )
        );

        User::where("id",$id)->update(["user_type"=>2,"password"=>bcrypt($request['password']),"status"=>1]);

        $password = $request['password'];

        $user = new User();

        $mailTo = $request->email;
        $subject = "Reviewer account created";
        $body = "Hey    ".$request['name'].",<br> You have been selected as a reviewer at Conf-master.<br>
        Your password is ".$password.".<br>Please stay connected<br>Sincerely,<br>Conf-master team";

        $user->mailUser($mailTo,$subject,$body);

        $file = $request->file('image');
        $filename = "reviewer-".$id . '.jpg'; //Filename as the name of the user

        //If retrieved image is a file
        if ($file) {
            $image = Image::make($file)->stream(); //Resizing image using Intervention Image
            Storage::disk('local')->put($filename, $image);  // Storing image in the disk as the name according to user id
        }

        return redirect()->route('reviewer_list',["pageTitle"=>"reviewer",'conference_id'=>$conference_id]);
    }

    public function EditReviewerGet($conference_id,$reviewerId){

        $reviewerBasicInfos = User::where("id",$reviewerId)->first();

          $scopes = DB::table('scopes')
                  ->join('tracks','scopes.track_id','=','tracks.id')
                  ->where('tracks.conference_id','=',$conference_id)->select('tracks.*','scopes.*','scopes.id as scope_id')->get();
		
		
        $userScope = DB::table('reviewer_scope')->where('user_id',$reviewerId)->first();
						
						
        return view("reviewer_edit",["scopes"=>$scopes,"userScope"=>$userScope,"pageTitle"=>"reviewer","conference_id"=>$conference_id,"reviewer"=>$reviewerBasicInfos]);


    }

    public function EditReviewerPost($conference_id , $reviewerId, Request $request){



        User::where("id",$reviewerId)->update($request->except(['_token','password','scope_id']));

        DB::table('reviewer_scope')->where('user_id',$reviewerId)->update([
            'scope_id'=>$request->scope_id
        ]);

        $id = $reviewerId;

        $file = $request->file('image');
        $filename = "reviewer-".$id . '.jpg'; //Filename as the name of the user
        //dd($request->password);
        if($request->password!="")
        {
            User::where("id",$id)->update(["user_type"=>2,"password"=>bcrypt($request->password)]);
        }
        //If retrieved image is a file
        if ($file) {
            $image = Image::make($file)->stream(); //Resizing image using Intervention Image
            Storage::disk('local')->put($filename, $image);  // Storing image in the disk as the name according to user id
        }

        return redirect()->route('reviewer_list',["conference_id"=>$conference_id]);

    }

    public function GetReviewerList($conference_id){

        $reviewerList = User::whereHas('conferences', function ($q) use ($conference_id) {
            $q->where('id', $conference_id);
         })->where("user_type",2)->with('conferences')->get();

        return view('reviewer_list',["pageTitle"=>"reviewer",'conference_id'=>$conference_id,'reviewerList'=>$reviewerList]);

    }

    public function DeleteReviewer($conference_id,$reviewer_id){

        $reviewer = User::where("id",$reviewer_id)->first();

        $reviewer->delete();

        return redirect()->route('reviewer_list',["conference_id"=>$conference_id]);
    }


    public function getReviewerImage($conference_id,$filename)
    {
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    public function GetReviewerDashboard(){

        $user= Auth::user();
       // dd($user);
        //$userInfo = User::where("id",$user->id)->with('conferences')->get();
        $conference_id = $user->conferences[0]->id;

        $userScopeId =  DB::table('reviewer_scope')->where('user_id',$user->id)->first()->scope_id;



        $files = DB::table("files")
                ->leftJoin('reviews','reviews.file_id','=','files.id')
                ->join("scopes","scopes.id",'=',"files.scope_id")
                ->where(function ($query) {
                        $query->where('status', '=', 0)
                        ->orWhere('status', '=', 1);
                })->where('scope_id',$userScopeId)
                ->select('files.id as file_unique_id','reviews.*','scopes.*','files.*')
                ->get();

            return view('reviewer_dashboard',["files"=>$files,"conference_id"=>$conference_id]);
    }


    public function SaveReview(Request $request){


        if(empty($request->score)||$request->score>30||$request->score<0)
             return response()->json(["error"=>true, "message" => "Score must be out of 30"]);


        $user = Auth::user();

        $review = Review::where("file_id",$request->file_id)->where("reviewer_id",$user->id)->first();
        $file = File::where("id",$request->file_id)->first();


        if(!is_null($review))
        {
                $review->reviewer_id = $user->id;
                $review->file_id = $request->file_id;
                $review->score = $request->score;
                $review->review_note = $request->note;

                if($review->save()){
                    $file->status = 1;
                    $file->save();
                    return response()->json(["success"=>true, "message" => "Review successfully saved"]);
                }else{
                    return response()->json(["error"=>true, "Failed to save review"]);
                }
        }
        else{
                $review = new Review();

                $review->reviewer_id = $user->id;
                $review->file_id = $request->file_id;
                $review->score = $request->score;
                $review->review_note = $request->note;

                if($review->save()){
                    $file->status = 1;
                    $file->save();
                    return response()->json(["success"=>true, "message" => "Review successfully saved"]);
                }else{
                    return response()->json(["error"=>true, "Failed to save review"]);
                }
        }


    }

}
