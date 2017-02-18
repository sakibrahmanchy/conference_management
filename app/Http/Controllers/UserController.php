<?php
namespace App\Http\Controllers;

use App\Advertisement;
use App\Notification;
use App\User;
use App\UserRequest;
use Illuminate\HTTP\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Collection;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
Use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    /**
     * @param Request $request
     */

    public function postSignUp(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|unique:users,userID|numeric',
            'name' => 'required',
            'password' => 'required|min:4'

        ]);
        $id = $request['id'];
        $name = $request['name'];
        $password = bcrypt($request['password']);

        $user = new User();
        $user->userId = $id;
        $user->name = $name;
        $user->password = $password;

        $user->save();
        //  session(['user_id'=>$id]);
        Auth::login($user);

        return redirect()->route('firstlogin');
    }

    public function firstLogin()
    {
        return view('firstlogin');
    }


    public function userInfoUpdate(Request $request)
    {

        //Weight assign for user points
        $weight = array('Professor' => 4,
            'Assistant Professor' => 3,
            'Lecturer' => 2,
            'Staff' => 1,
            'am' => 2,
            'pm' => 1);

        //Validation of form
        $this->validate($request, [
            'presentDesignation' => 'required|not_in:0',
            'pdJoiningDate' => 'required',
            'joiningTime' => 'required|not_in:0',
            'payScale' => 'required|not_in:0',
            'firstDesignation' => 'required|not_in:0',
            'firstJoiningDate' => 'required',
            'maritalStatus' => 'required|not_in:0',
            'department' => 'required',
            'phone' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg'
        ]);

        //Retrieving form values
        $user = Auth::user();
        $id = $user->userID;
        $presentDesignation = $request['presentDesignation'];
        $pdJoiningDate = Carbon::createFromFormat('Y-m-d', $request['pdJoiningDate'])->toDateString();
        $joiningTime = $request['joiningTime'];
        $payScale = $request['payScale'];
        $firstDesignation = $request['firstDesignation'];
        $firstJoiningDate = Carbon::createFromFormat('Y-m-d', $request['firstJoiningDate'])->toDateString();
        $maritalStatus = $request['maritalStatus'];
        $department = $request['department'];
        $phone = $request['phone'];
        $file = $request->file('image');


        $filename = $id . '.jpg'; //Filename as the name of the user

        //If retrieved image is a file
        if ($file) {
            $image = Image::make($file)->resize(250, 250)->stream(); //Resizing image using Intervention Image
            Storage::disk('local')->put($filename, $image);  // Storing image in the disk as the name according to user id
        }

        //Point calculation of the user
        $point = $weight[$presentDesignation] + $weight[$joiningTime] + $weight[$firstDesignation];
        $point = ($point / 10) * 100;

        //Storing values in the database
        $user = User::where('userId', $id)->first();
        $user->presentDesignation = $presentDesignation;
        $user->pdJoiningDate = $pdJoiningDate;
        $user->pdjoiningTime = $joiningTime;
        $user->payScale = $payScale;
        $user->firstDesignation = $firstDesignation;
        $user->firstJoiningDate = $firstJoiningDate;
        $user->maritalStatus = $maritalStatus;
        $user->department = $department;
        $user->phone = $phone;
        $user->point = $point;
        $user->save();

        //Confirmation
        Auth::logout($user);
        notify()->flash('Thank you! Please wait until your data is verified!', 'success');
        return redirect()->to('/');
    }

    public function getUserImage($filename)
    {


        //Image resizing using Intervention Image
        /* $image = Image::make( Storage::disk('local')->get($filename) )->resize(250,250)->stream();

         Storage::disk('local')->put($filename, $image);*/

        //Retrieving image from storage
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    public function postSignIn(Request $request)
    {


        $this->validate($request, [
            'id' => 'required',
            'password' => 'required'

        ]);

        if($request['id']=="admin" && $request['password']=='331412')
        {
                session(['admin'=>"true"]);
                notify()->flash('Successfully logged in!', 'success');
                return redirect()->route('admin.panel');

        }
        else{
        if (Auth::attempt(['userID' => $request['id'], 'password' => $request['password']])) {
            $status = User::where('userID', $request['id'])->first();
            $st = $status->status;
            if ($st == "Verified") {
                notify()->flash('Successfully logged in!', 'success');
                return redirect()->route('dashboard');
            } else {
                notify()->flash('Sorry you are not verified yet. Please try later!', 'warning');
                return redirect()->back();
            }
        } else {
            notify()->flash('Incorrect Credentials', 'warning');
            return redirect()->back();
        }

        }


    }


    public function  verifySignup()
    {
        return view('verifysignup');
    }

    public function getLogout()
    {
        if(session('admin')=="true")
        {
            session(['admin'=>"false"]);
        }
        Auth::logout();
        return redirect()->route('home');
    }

    public function getAccount()
    {
        return view('account', ['user' => Auth::user()]);
    }

    public function postSaveAccount(Request $request)
    {

        $this->validate($request, [
            'name'=>'required',
            'presentDesignation' => 'required',
            'payScale' => 'required',
            'phone' => 'required'
        ]);


          $weight = array('Professor' => 4,
            'Assistant Professor' => 3,
            'Lecturer' => 2,
            'Staff' => 1,
            'am' => 2,
            'pm' => 1);



        $user = Auth::user();

        $presentDesignation = $request['presentDesignation'];
        $user->name = $request['name'];
        $user->presentDesignation = $request['presentDesignation'];

        $point = $weight[$presentDesignation] + $weight[$user->pdJoiningTime] + $weight[$user->firstDesignation];
        $point = ($point / 10) * 100;
        $user->point = $point;
        $user->payScale = $request['payScale'];
        $user->phone = $request['phone'];
        $user->update();

        $file = $request->file('image');
        $filename =  $user->userID . '.jpg';
        if ($file) {
            Storage::disk('local')->put($filename, File::get($file));
        }
        return redirect()->route('account');
    }

    public function getDashBoard()
    {
        $advertisements = DB::table('advertisements')->join('allotments', 'advertisements.houseName', '=', 'allotments.houseName')->get();

        return view('dashboard', ['advertisements' => $advertisements]);
    }

    public function requestAllotment($houseName)
    {

        $userRequest = new UserRequest();
        $user = Auth::user();
        $userId = $user->userID;
        $exists = UserRequest::where('user_id', $userId)->where('houseName', $houseName)->first();
        if (!$exists) {
            $userRequest->houseName = $houseName;
            $userRequest->user_id = $userId;
            $userRequest->save();
            return redirect()->route('dashboard');
        } else {
            notify()->flash('Sorry! You have already requested for this house!', 'warning');
            return redirect()->route('dashboard');
        }

    }

    public function getContact(){
        return view('contact');
    }

    public function postNotifications(Request $request, $to)
    {
      $this->validate($request, [
            'message'=>'required'
        ]);
      if(session("admin")=="true")
      {
          $from = "admin";
      }else
      {
         $from = Auth::User()->userID;
      }

      $message = $request['message'];
      $notification = new Notification();
      $notification->from = $from;
      $notification->to = $to;
      $notification->message = $message;
      $notification->save();
      notify()->flash('Message successfully sent','success');
      return redirect()->route('getContact');

    }

    public function getNotifications()
    {
         $admin = "admin";
         if(session('admin')=="true")
         {
             $notifications = Notification::where('to',$admin)->orderBy('created_at','desc')->get();

            return view('notifications',['notifications'=>$notifications]);
         }
         else if(Auth::check())
         {
             $user = Auth::user();
             $notifications = Notification::where('to',$user->userID)->get();
             return view('notifications',['notifications'=>$notifications]);
         }
    }
}