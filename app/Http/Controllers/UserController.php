<?php
namespace App\Http\Controllers;

use App\Advertisement;
use App\Conference;
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
            'email' => 'required|unique:users|email',
            'name' => 'required',
            'password' => 'required|min:6',
            'address' => 'required'

        ]);

        $email = $request['email'];
        $name = $request['name'];
        $password = bcrypt($request['password']);
        $description = $request['address'];
        $phone = $request['phone'];
        $facebook = $request['facebook'];
        $twitter = $request['twitter'];

        $file = $request->file('image');

        $user = new User();
        $user->email = $email;
        $user->name = $name;
        $user->password = $password;
        $user->description = $description;
        $user->phone = $phone;
        $user->facebook_username = $facebook;
        $user->twitter_username = $twitter;
        $user->user_type = 1;

        $user->save();


        $id = "user-".$user->id;

        $filename = $id . '.jpg'; //Filename as the name of the user

        //If retrieved image is a file
        if ($file) {
            $image = Image::make($file)->stream(); //Resizing image using Intervention Image
            Storage::disk('local')->put($filename, $image);  // Storing image in the disk as the name according to user id
        }
        //  session(['user_id'=>$id])

        notify()->flash('Thank you! Please wait until your data is verified!', 'success');
        return redirect()->to('/admin');
        //return redirect()->route('firstlogin');
    }

    public function firstLogin()
    {
        if(Auth::check())
            return redirect()->route('home');
        else
            return view('firstlogin');
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
            'email' => 'required',
            'password' => 'required'

        ]);


        if (Auth::validate(['email' => $request['email'], 'password' => $request['password']])) {
            $user = User::where('email', $request['email'])->first();
            $st = $user->status;
            if ($st == 1) {
                Auth::login($user, $request->has('remember'));
                if($user->user_type==0)
                {
                    notify()->flash('Successfully logged in!', 'success');
                    return redirect()->route('user.requests');
                }else if($user->user_type==1){

                    notify()->flash('Successfully logged in!', 'success');
                    return redirect()->route('get_conferences');

                }else if($user->user_type==2) {

                    notify()->flash('Successfully logged in!', 'success');
                    return redirect()->route('reviewer_dashboard');

                }else if($user->user_type==3){

                    $conference_id = $request->conference_id;
                    session(['conference_id' => $conference_id]);
                    notify()->flash('Successfully logged in!', 'success');
                    return redirect()->route('submissions_get',["conference_id"=>$conference_id]);

                }

            } else {
                notify()->flash('Sorry you are not verified yet. Please try later!', 'warning');
                return redirect()->back();
            }
        } else {
            notify()->flash('Incorrect Credentials', 'warning');
            return redirect()->back();
        }




    }


    public function  verifySignup()
    {
        return view('verifysignup');
    }

    public function getLogout()
    {
        Auth::logout();
        if( session('conference_id') )
        {

            $conference_id = session('conference_id');
            return redirect()->route('submit_welcome',["conference_id"=>$conference_id]);
        }

        return redirect()->route('home');
    }

    public function getAccount()
    {
        $user = Auth::user();
        if($user->user_type==1){
            return view('account', ['user' => $user]);
        }
        else if($user->user_type==2){
            return view('reviewer_account', ['user' => $user]);
        }
        else if($user->user_type==3){
            $conference_id = $_GET['conference_id'];
            return view('user_account', ['user' => $user,"conference_id"=>$conference_id]);
        }

    }

    public function postSaveAccount(Request $request)
    {

         $this->validate($request, [
            'name' => 'required',
        ]);

        $email = $request['email'];
        $name = $request['name'];

        $description = $request['address'];
        $phone = $request['phone'];
        $facebook = $request['facebook'];
        $twitter = $request['twitter'];


        $user = Auth::user();


        $user->email = $email;
        $user->name = $name;
        if($request['password']!=null){
            $password = bcrypt($request['password']);
            $user->password = $password;
        }
        $user->description = $description;
        $user->phone = $phone;
        $user->facebook_username = $facebook;
        $user->twitter_username = $twitter;
        $user->user_type = 1;

        $user->save();

        $file = $request->file('image');
        $filename =  "user-".$user->id . '.jpg';
        if ($file) {
            Storage::disk('local')->put($filename, File::get($file));
        }
        return redirect()->route('home');
    }



        public function getAllConferences(){
            $conferenceList = Conference::all();
            return view('all_conference_universe',['conferenceList'=>$conferenceList]);
        }






}