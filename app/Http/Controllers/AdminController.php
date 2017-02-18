<?php
namespace App\Http\Controllers;

use App\Allotment;
use App\Notification;
use App\User;
use App\Advertisement;
use App\UserRequest;

use Illuminate\HTTP\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Collection;
use Carbon\Carbon;
Use Illuminate\Support\Facades\DB;
use Mockery\Matcher\Not;

class AdminController extends Controller
{



    public function getAdminPanel()
    {
         $allotmentStatus = Allotment::where('allotmentstatus' ,"free")->get();
         $requests = User::where('status','Not Verified')->count();
         return view('adminpanel',['requests'=>$requests,'allotmentStatus'=>$allotmentStatus]);
    }

    public function routeHouseEntry()
    {
         $requests = User::where('status','Not Verified')->count();
         return view('houseentry',['requests'=>$requests]);
    }



    public function adminLogin()
    {
        return view('adminlogin');
    }

    public function advertisePost(Request $request)
    {
         $this->validate($request, [
            'houseNo' => 'required|not_in:0',
            'comments'=>'required',        ]);

        $allotment = Allotment::where('houseName',$request['houseNo'])->first();
        $allotment->allotmentStatus = 'advertised';
        $advertisement = new Advertisement();
        $advertisement->houseName = $request['houseNo'];
        $advertisement->comments = $request['comments'];
        $advertisement->save();
        $allotment->save();
        return redirect()->back();
    }

    public function houseEntry(Request $request)
    {

        $this->validate($request, [
            'houseNo' => 'required',
            'houseDescription'=>'required',
            'houseType'=>'required|not_in:0',
            'houseStatus'=>'required|not_in:0'
        ]);

        $houseNo = $request['houseNo'];
        $houseDescription = $request['houseDescription'];
        $houseType = $request['houseType'];
        $houseStatus = $request['houseStatus'];

        $allotments = new Allotment();
        $allotments->houseName = $houseNo;
        $allotments->houseDescription = $houseDescription;
        $allotments->houseType = $houseType;
        $allotments->allotmentStatus = $houseStatus;

        $allotments->save();
        notify()->flash('House inserted successfully','success');
        return redirect()->route('route.house.entry');
    }



    public function getUserRequests()
    {
        $userRequests = User::where('status' ,"Not Verified")->orderBy('updated_at', 'desc','point','desc')->get();

         return view('userrequests',['userRequests'=>$userRequests]);
    }

    public function UserAccept($userid)
    {
        $user = User::where('userID',$userid)->first();
        $user->status = 'Verified';
        $user->save();

        $notification = new Notification();
        $notification->message="Your request has been accepted. You are now a verified user";
        $notification->to = $userid;
        $notification->from = "admin";
        $notification->save();

        return redirect()->route('user.requests');
    }

    public function UserReject($userid)
    {
        $user = User::where('userID',$userid)->first();
        $user->delete();
        return redirect()->route('user.requests');
    }

    public function allotmentAccept($userid,$housename)
    {
        $allotment = Allotment::where('houseName',$housename)->first();
        $allotment->user_id = $userid;
        $allotment->save();

        $notification = new Notification();
        $notification->message="Your request for ".$housename." has been accepted. You will be allotted to the house shortly.";
        $notification->to = $userid;
        $notification->from = "admin";
        $notification->save();

        return redirect()->route('allotments');
    }

     public function allotmentReject($userid,$housename)
    {
        $userRequest = UserRequest::where('houseName',$housename)->where('user_id',$userid)->first();
        $userRequest->delete();

        $notification = new Notification();
        $notification->message="Sorry! Your request for ".$housename." was not accepted.";
        $notification->to = $userid;
        $notification->from = "admin";
        $notification->save();

        return redirect()->route('allotments');
    }



    public function getAllotments()
    {

        $userRequests = DB::table('user_requests')->join('allotments', 'user_requests.houseName', '=', 'allotments.houseName')
            ->join('users','user_requests.user_id','=','users.userID')->groupBy('allotments.houseName')->orderBy('point','desc','pdJoiningDate','asc','firstJoiningDate','asc')->get();

        $requests = User::where('status','Not Verified')->count();
        return view('allotments',['userRequests'=>$userRequests,'requests'=>$requests]);
    }

    public function sortedUsers($housename)
    {
        $userRequests = DB::table('user_requests')->join('allotments', 'user_requests.houseName', '=', 'allotments.houseName')
            ->join('users','user_requests.user_id','=','users.userID')->orderBy('point','desc','pdJoiningDate','asc','firstJoiningDate','asc')->
            where('user_requests.houseName',$housename)->get();

        $requests = User::where('status','Not Verified')->count();
        return view('userrequestssorted',['userRequests'=>$userRequests,'requests'=>$requests,'housename'=>$housename]);
    }



}
