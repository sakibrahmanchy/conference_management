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
   return view('welcome');
})->name('home');

Route::post('/signup',[
   'uses' => 'UserController.php@postSignUp',
    'as' => 'signup'
]);
Route::post('/signin',[
   'uses' => 'UserController.php@postSignIn',
    'as' => 'signin'
]);

Route::get('/logout',[
   'uses' => 'UserController.php@getLogout',
    'as' => 'logout'
]);

Route::get('/account',[
   'uses' => 'UserController.php@getAccount',
    'as' => 'account'
]);

Route::post('updateAccount',[
   'uses' => 'UserController.php@postSaveAccount',
    'as' => 'account.save'
]);

Route::get('/dashboard',[
   'uses' => 'PostController@getDashBoard',
    'as' => 'dashboard',
    'middleware' => 'auth'
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
   'uses' => 'UserController.php@getUserImage',
    'as'=> 'account.image'
]);


Route::post('/edit',[
    'uses' => 'PostController@postEditPost',
    'as'=>'edit'
]);





