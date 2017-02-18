<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/




Route::get('/',function(){

    if(session('admin')=="true")
        return redirect()->route('admin.panel');
    else
        return view('welcome');
})->name('home');

Route::post('/signup',[
   'uses' => 'UserController@postSignUp',
    'as' => 'signup'
]);
Route::post('/signin',[
   'uses' => 'UserController@postSignIn',
    'as' => 'signin'
]);

Route::get('/logout',[
   'uses' => 'UserController@getLogout',
    'as' => 'logout'
]);

Route::get('/admin.login',
[
 'uses'=>'AdminController@adminLogin',
    'as' => 'admin.login'
]
);


Route::post('/admin.verify',[
    'uses'=>'AdminController@adminVerify',
    'as'=>'admin.verify'
]);

Route::get('/route.house.entry',[
    'uses'=>'AdminController@routeHouseEntry',
    'as'=>'route.house.entry'
]);

Route::post('/house.entry',[
    'uses'=>'AdminController@houseEntry',
    'as'=>'house.entry'
]);

Route::get('/admin.panel',[
    'uses'=>'AdminController@getAdminPanel',
    'as'=>'admin.panel'
]);

Route::get('/verify.signup',[
    'uses'=>'UserController@verifySignup',
    'as'=>'verify.signup'
]);

Route::post('/advertise.post',[
    'uses'=>'AdminController@advertisePost',
    'as'=>'advertise.post'
]);

Route::get('/user.requests',[
    'uses'=>'AdminController@getUserRequests',
    'as'=>'user.requests'
]);

Route::get('/allotments',[
    'uses'=>'AdminController@getAllotments',
    'as'=>'allotments'
]);


Route::get('/userimage/{filename}',[
    'uses'=>'UserController@getUserImage',
    'as'=>'account.image'
]);

Route::get('/user.accept/{userid}',[
    'uses'=>'AdminController@UserAccept',
    'as'=>'user.accept'
]);

Route::get('/user.reject/{userid}',[
    'uses'=>'AdminController@UserReject',
    'as'=>'user.reject'
]);

Route::get('/allotment.accept/{userid}/{housename}',[
    'uses'=>'AdminController@allotmentAccept',
    'as'=>'allotment.accept'
]);

Route::get('/allotment.reject/{userid}/{housename}',[
    'uses'=>'AdminController@allotmentReject',
    'as'=>'allotment.reject'
]);

Route::get('/notifications',[
    'uses'=>'UserController@getNotifications',
    'as'=>'getNotifications'
]);

Route::get('/admin.login',[
   'uses' => 'AdminController@adminLogin',
    'as' => 'admin.login'
]);

Route::get('/account',[
   'uses' => 'UserController@getAccount',
    'as' => 'account'
]);
Route::get('/firstlogin',[
    'uses' => 'UserController@firstLogin',
    'as' => 'firstlogin'
]);

Route::post('updateAccount',[
   'uses' => 'UserController@postSaveAccount',
    'as' => 'account.save'
]);

Route::get('/dashboard',[
   'uses' => 'UserController@getDashBoard',
    'as' => 'dashboard',
    'middleware' => 'auth'
]);

Route::post('/userinfoupdate',[
   'uses' => 'UserController@userInfoUpdate',
    'as' => 'userinfoupdate'
]);

Route::post('/createpost',[
   'uses' => 'PostController@postCreatePost',
    'as' => 'post.create',
    'middleware' => 'auth'
]);

Route::get('/deletepost/{user_id}',[
   'uses' => 'PostController@getDeletePost',
    'as'=> 'post.delete',
    'middleware' => 'auth'
]);


Route::get('/userimage/{filename}',[
   'uses' => 'UserController@getUserImage',
    'as'=> 'account.image'
]);


Route::post('/edit',[
    'uses' => 'PostController@postEditPost',
    'as'=>'edit'
]);

Route::get('/requestallotment/{housename}',[
    'uses' => 'UserController@requestAllotment',
    'as'=>'request.allotment'
]);

Route::get('/sortedusers/{housename}',[
    'uses' => 'AdminController@sortedUsers',
    'as'=>'sorted.users'
]);

Route::get('/getContact',[
    'uses' => 'UserController@getContact',
    'as'=>'getContact'
]);

Route::post('/postnotifications/{to}',[
    'uses' => 'UserController@postNotifications',
    'as'=>'post.notifications',
    'middleware'=>'auth'
]);




