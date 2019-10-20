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


 Route::get('/',[
    'uses'=>'UserController@getAllConferences',
    'as'=>'conference_universe'
    ]);

Route::get('/admin',function(){

    $user = \Illuminate\Support\Facades\Auth::user();

    if($user!=null&&$user->user_type==0)
        return redirect()->route('user.requests');
    else if($user!=null&&$user->user_type==1)
        return redirect()->route('get_conferences');
    else if($user!=null&&$user->user_type==2)
        return redirect()->route('reviewer_dashboard');
    else
        return view('welcome');

})->name('home');

Route::get('403',function(){
     return view('errors.403');
})->name('403');



Route::get("/{conference_url}",['uses'=>'ConferenceController@GetConferenceHomePage','as'=>'conference_home']);


Route::get('/admin/conference/edit/{conference_id}/speaker/image/{filename}',[
    'uses'=>'SpeakerController@getSpeakerImage',
    'as'=>'speaker_image'
    ]);


Route::get('/admin/conference/edit/{conference_id}/track/image/{filename}',[
    'uses'=>'TrackController@getTrackImage',
    'as'=>'track_image'
    ]);


Route::get('/admin/conference/edit/{conference_id}/reviewer/image/{filename}',[
        'uses'=>'ReviewerController@getReviewerImage',
        'as'=>'reviewer_image'
    ]);


Route::group(['middleware' => ['auth', 'admin']], function() {

   Route::get('/admin/user.requests',[
    'uses'=>'AdminController@getUserRequests',
    'as'=>'user.requests'
    ])->middleware('superadmin');

    Route::get('/admin/conference/all',[
    'uses'=>'ConferenceController@getAllConferences',
    'as'=>'all_conferences'
    ])->middleware('superadmin');

    Route::get('/admin/conference/create',['uses'=>'ConferenceController@CreateConferenceGet','as'=>'create_conference']);
    Route::post('/admin/conference/create',['uses'=>'ConferenceController@CreateConferencePost','as'=>'create_conference']);
    Route::get('/admin/conference/list',['uses'=>'ConferenceController@GetConferenceList','as'=>'get_conferences']);
    Route::get('/admin/conference/edit/{conference_id}/basic/',['uses' => 'ConferenceController@EditConferenceGet','as' => 'edit_conference']);
    Route::post('/admin/conference/edit/{conference_id}/basic/',['uses' => 'ConferenceController@EditConferencePost','as' => 'edit_conference']);

    Route::get('/admin/conference/edit/{conference_id}/important_dates/',['uses' => 'ConferenceController@EditConferenceDatesGet','as' => 'edit_conference_dates']);
    Route::post('/admin/conference/edit/{conference_id}/important_dates/',['uses' => 'ConferenceController@EditConferenceDatesPost','as' => 'edit_conference_dates']);

    Route::get('/admin/conference/edit/{conference_id}/terms/',['uses' => 'ConferenceController@EditConferenceTermsGet','as' => 'edit_conference_terms']);
    Route::post('/admin/conference/edit/{conference_id}/terms/',['uses' => 'ConferenceController@EditConferenceTermsPost','as' => 'edit_conference_terms']);


    Route::get('/admin/conference/edit/{conference_id}/speaker',['uses'=>'SpeakerController@GetSpeakerList','as'=>'speaker_list']);
    Route::get('/admin/conference/edit/{conference_id}/speaker/create',['uses'=>'SpeakerController@CreateSpeakerGet','as'=>'create_speaker']);
    Route::post('/admin/conference/edit/{conference_id}/speaker/create',['uses'=>'SpeakerController@CreateSpeakerPost','as'=>'create_speaker']);
    Route::get('/admin/conference/edit/{conference_id}/speaker/edit/{speaker_id}',['uses'=>'SpeakerController@EditSpeakerGet','as'=>'edit_speaker']);
    Route::post('/admin/conference/edit/{conference_id}/speaker/edit/{speaker_id}',['uses'=>'SpeakerController@EditSpeakerPost','as'=>'edit_speaker']);
    Route::get('/admin/conference/edit/{conference_id}/speaker/delete/{speaker_id}',['uses'=>'SpeakerController@DeleteSpeaker','as'=>'delete_speaker']);


    Route::get('/admin/conference/edit/{conference_id}/reviewer',['uses'=>'ReviewerController@GetReviewerList','as'=>'reviewer_list']);
    Route::get('/admin/conference/edit/{conference_id}/reviewer/create',['uses'=>'ReviewerController@CreateReviewerGet','as'=>'create_reviewer']);
    Route::post('/admin/conference/edit/{conference_id}/reviewer/create',['uses'=>'ReviewerController@CreateReviewerPost','as'=>'create_reviewer']);
    Route::get('/admin/conference/edit/{conference_id}/reviewer/edit/{reviewer_id}',['uses'=>'ReviewerController@EditReviewerGet','as'=>'edit_reviewer']);
    Route::post('/admin/conference/edit/{conference_id}/reviewer/edit/{reviewer_id}',['uses'=>'ReviewerController@EditReviewerPost','as'=>'edit_reviewer']);
    Route::get('/admin/conference/edit/{conference_id}/reviewer/delete/{reviewer_id}',['uses'=>'ReviewerController@DeleteReviewer','as'=>'delete_reviewer']);


    Route::get('/admin/conference/edit/{conference_id}/track',['uses'=>'TrackController@GetTrackList','as'=>'track_list']);
    Route::get('/admin/conference/edit/{conference_id}/track/create',['uses'=>'TrackController@CreateTrackGet','as'=>'create_track']);
    Route::post('/admin/conference/edit/{conference_id}/track/create',['uses'=>'TrackController@CreateTrackPost','as'=>'create_track']);
    Route::get('/admin/conference/edit/{conference_id}/track/edit/{track_id}',['uses'=>'TrackController@EditTrackGet','as'=>'edit_track']);
    Route::post('/admin/conference/edit/{conference_id}/track/edit/{track_id}',['uses'=>'TrackController@EditTrackPost','as'=>'edit_track']);
    Route::get('/admin/conference/edit/{conference_id}/track/delete/{track_id}',['uses'=>'TrackController@DeleteTrack','as'=>'delete_track']);


    Route::get('/admin/conference/edit/{conference_id}/scope',['uses'=>'ScopeController@GetScopeList','as'=>'scope_list']);
    Route::get('/admin/conference/edit/{conference_id}/scope/create',['uses'=>'ScopeController@CreateScopeGet','as'=>'create_scope']);
    Route::post('/admin/conference/edit/{conference_id}/scope/create',['uses'=>'ScopeController@CreateScopePost','as'=>'create_scope']);
    Route::get('/admin/conference/edit/{conference_id}/scope/edit/{scope_id}',['uses'=>'ScopeController@EditScopeGet','as'=>'edit_scope']);
    Route::post('/admin/conference/edit/{conference_id}/scope/edit/{scope_id}',['uses'=>'ScopeController@EditScopePost','as'=>'edit_scope']);
    Route::get('/admin/conference/edit/{conference_id}/scope/delete/{scope_id}',['uses'=>'ScopeController@DeleteScope','as'=>'delete_scope']);


    Route::get('/admin/conference/edit/{conference_id}/committee',['uses'=>'CommitteeController@GetCommitteeList','as'=>'committee_list']);
    Route::get('/admin/conference/edit/{conference_id}/committee/create',['uses'=>'CommitteeController@CreateCommitteeGet','as'=>'create_committee']);
    Route::post('/admin/conference/edit/{conference_id}/committee/create',['uses'=>'CommitteeController@CreateCommitteePost','as'=>'create_committee']);
    Route::get('/admin/conference/edit/{conference_id}/committee/edit/{committee_id}',['uses'=>'CommitteeController@EditCommitteeGet','as'=>'edit_committee']);
    Route::post('/admin/conference/edit/{conference_id}/committee/edit/{committee_id}',['uses'=>'CommitteeController@EditCommitteePost','as'=>'edit_committee']);
    Route::get('/admin/conference/edit/{conference_id}/committee/delete/{committee_id}',['uses'=>'CommitteeController@DeleteCommittee','as'=>'delete_committee']);

    Route::get('/admin/conference/{conference_id}/submissions/judge',['uses' => 'SubmissionController@JudgeSubmissions', 'as' => 'submissions_judge']);
    Route::get('/admin/conference/{conference_id}/submissions',['uses' => 'SubmissionController@ShowSubmissions', 'as' => 'submissions_show']);
    Route::get('/admin/conference/edit/{conference_id}/submissions/accept/{submission_id}',[
        'uses'=>'SubmissionController@AcceptSubmission',
        'as'=>'accept_submission'
    ]);
    Route::get('/admin/conference/edit/{conference_id}/submissions/reject/{submission_id}',[
        'uses'=>'SubmissionController@RejectSubmission',
        'as'=>'reject_submission'
    ]);

});

Route::get('/reviewer/dashboard',[
    'uses' => 'ReviewerController@GetReviewerDashboard',
    'as' => 'reviewer_dashboard'
])->middleware('auth','admin');

Route::post('/reviewer/review/save',[
    'uses' => 'ReviewerController@SaveReview',
    'as' => 'save_review'
])->middleware('auth');


Route::get('conference/{conference_id}/submit_paper/account',[
    'uses' => 'SubmissionController@getAccount',
    'as' => 'submit_account'
])->middleware('auth');

Route::post('conference/{conference_id}/submit_paper/update/abstract/{submission_id}',[
    'uses' => 'SubmissionController@EditAbstract',
    'as' => 'update_abstract'
])->middleware('auth');

Route::get('conference/{conference_id}/submit_paper/submissions',[
    'uses' => 'SubmissionController@GetSubmissions',
    'as' => 'submissions_get'
])->middleware('auth');


Route::get('conference/{conference_id}/submit_paper/submit_files',[
    'uses' => 'SubmissionController@GetSubmitFiles',
    'as' => 'submit_files'
])->middleware('auth');

Route::post('conference/{conference_id}/submit_paper/submit_files',[
    'uses' => 'SubmissionController@PostSubmitFiles',
    'as' => 'submit_files'
])->middleware('auth');


Route::get('conference/{conference_id}/submit_paper/dashboard','SubmissionController@SubmitDashboard')->name('submit_dashboard')->middleware('auth');
Route::get('conference/{conference_id}/submit_paper/welcome',['uses'=>'SubmissionController@SubmissionWelcomeGet'])->name('submit_welcome');

Route::get('conference/{conference_id}/submit_paper/download_file/{file_name}','SubmissionController@downloadFile')->name('download_file');

Route::get('conference/{conference_id}/submit_paper/signup',['uses'=>'SubmissionController@SubmissionSignupGet'])->name('submit_signup_get');

Route::post('conference/{conference_id}/submit_paper/signup',[
   'uses' => 'SubmissionController@SubmitSignUp',
    'as' => 'submit_signup_post'
]);



Route::post('/signup',[
   'uses' => 'UserController@postSignUp',
    'as' => 'signup'
]);

Route::post('/signin',[
   'uses' => 'UserController@postSignIn',
    'as' => 'signin'
]);

Route::get('/admin/logout',[
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



Route::get('/verify.signup',[
    'uses'=>'UserController@verifySignup',
    'as'=>'verify.signup'
]);

Route::post('/advertise.post',[
    'uses'=>'AdminController@advertisePost',
    'as'=>'advertise.post'
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

Route::get('/admin/account',[
   'uses' => 'UserController@getAccount',
    'as' => 'account'
]);
Route::get('/admin/firstlogin',[
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


Route::get('/userimage/{filename}',[
   'uses' => 'UserController@getUserImage',
    'as'=> 'account.image'
]);


Route::post('/postnotifications/{to}',[
    'uses' => 'UserController@postNotifications',
    'as'=>'post.notifications',
    'middleware'=>'auth'
]);




