<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(url('/posts'));
});

Route::get('test', function () {
    event(new App\Events\StatusLiked('Someone'));

    return "Event has been sent!";
});
Auth::routes();
Route::get('forgetPasswordEmail', [ForgotPasswordController::class, 'forgetPasswordEmail'])->name('forgetPasswordEmail');
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::post('message', 'App\Http\Controllers\HomeController@sendMessage'); //
    Route::resource('posts', 'App\Http\Controllers\PostesController'); //
    Route::get('/message/{id}', 'App\Http\Controllers\HomeController@getMessage')->name('message');
    Route::get('/ShowMassage/{id}', 'App\Http\Controllers\HomeController@ShowMassage');
    Route::get('/messag/{id}', 'App\Http\Controllers\HomeController@getMessag')->name('message');
    Route::get('/subscribe', 'App\Http\Controllers\HomeController@subscribe');
    Route::delete('/unFollow/{id}', 'App\Http\Controllers\HomeController@remove_user');
/////////////////////
    Route::get('/group/create', 'App\Http\Controllers\GroupController@create_form');
    Route::post('/group/create', 'App\Http\Controllers\GroupController@create');
    Route::get('/group/join', 'App\Http\Controllers\GroupController@join_form');
    Route::post('/group/join', 'App\Http\Controllers\GroupController@join');

    Route::get('/group/edit/{id}', 'App\Http\Controllers\GroupController@edit');
    Route::get('/group/{id}', 'App\Http\Controllers\GroupController@show')->name('groups.show');

    Route::post('/group/update/{id}', 'App\Http\Controllers\GroupController@update');

    Route::delete('/group/delete/{id}', 'App\Http\Controllers\GroupController@deleteGroup');

    Route::get('/group/members_list/{id}', 'App\Http\Controllers\GroupController@members_list');

    Route::get('/remove_user/{id}/{user_id}', 'App\Http\Controllers\GroupController@remove_user');
    Route::resource('siteProfile', 'App\Http\Controllers\ProfileController');
    Route::resource('comments', 'App\Http\Controllers\CommentController');
    Route::get('pArticles/{id}', 'App\Http\Controllers\ProfileController@pArticles');
    Route::post('siteProfile\resumes', 'App\Http\Controllers\ProfileController@resumes')->name('resumes.store');

    Route::resource('Notifications', 'App\Http\Controllers\NotificationsController');
    Route::post('askForHelp', 'App\Http\Controllers\HomeController@askForHelp')->name('askForHelp');
    Route::get('my-notifications', 'App\Http\Controllers\NotificationsController@myNotifications')->name('my-notifications');
    Route::post('/broadcast', 'App\Http\Controllers\PusherController@broadcast');
    Route::post('/receive', 'App\Http\Controllers\PusherController@receive');
    Route::get('/terms/{accept}', 'App\Http\Controllers\TermsController@update')->name('terms');


});
