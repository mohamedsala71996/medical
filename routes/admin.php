<?php


/* Route::get('test/{id}',function (){
    admin()->loginUsingId(1, true);
    return redirect()->route('admin.dashboard');

});*/

use App\Http\Controllers\Admin\AdminDriverController;
use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MapMessageController;
use App\Models\FirebaseToken;
use App\Models\NotificationSetting;
use App\Http\Traits\FirebaseMultiTrait;
use Illuminate\Support\Facades\Config;


Route::group(['prefix' => 'admin'], function () {

    config::set('auth.defines', 'admin');
    /*====================Start Admin Auth System==================*/
    Route::get('login', 'App\Http\Controllers\Admin\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'App\Http\Controllers\Admin\AdminLoginController@login')->name('admin.login.submit');
    /*====================End Admin Auth System==================*/
    /*====================Admin Panel==================*/
    Route::group(['middleware' => 'admin:admin'], function () {

        /*================LogOut===========*/
        Route::post('logout', 'App\Http\Controllers\Admin\AdminLoginController@logout')->name('admin.logout');
        /*================Admin Home =========================*/
        Route::get('/home', 'App\Http\Controllers\Admin\AdminController@index')->name('admin.dashboard');
        /*================Admin Home =========================*/
        /*================Admin Setting control =========================*/
        Route::resource('setting', 'App\Http\Controllers\Admin\AdminSettingController');//setting
        Route::resource('sliders', 'App\Http\Controllers\Admin\AdminSlidersController');//sliders
        Route::resource('socials', 'App\Http\Controllers\Admin\AdminSocialController');//socials
        //site texts
        Route::resource('siteTexts', 'App\Http\Controllers\Admin\AdminTextController');
        Route::post('siteTexts/delete', 'App\Http\Controllers\Admin\AdminTextController@delete')->name('siteTexts.delete');
        //firbase Notification
        /*            Route::resource('FirebaseNotification','AdminFirebaseNotificationController');
         */            //snd email to enyone
        Route::resource('adminEmails', 'App\Http\Controllers\Admin\SendEmailController');
        Route::post('adminEmails/email', 'App\Http\Controllers\Admin\SendEmailController@send_Email')->name('adminEmails.send');

        /*================Admin Setting control =========================*/
        /*================Admin Profile control =========================*/
        Route::resource('profile', 'App\Http\Controllers\Admin\AdminProfileController');
        Route::get('profile/password/{id}', 'App\Http\Controllers\Admin\AdminProfileController@update_pass_view')->name('profile.change.pass.view');
        Route::post('profile/password/change', 'App\Http\Controllers\Admin\AdminProfileController@update_pass')->name('profile.change.pass');

        //==================Theme=======================================*/
        Route::post('slider_color', 'App\Http\Controllers\Admin\AdminThemeController@changeSliderColor')->name('changeSliderColor');
        Route::post('header_color', 'App\Http\Controllers\Admin\AdminThemeController@changeHeaderColor')->name('changeHeaderColor');
        /*================Admin Admin control =========================*/
        Route::resource('admins', 'App\Http\Controllers\Admin\AdminAdminController');
        /*================Admin Users control =========================*/
        Route::resource('users', 'App\Http\Controllers\Admin\AdminUserController');
        Route::get('users/active/{id}', 'App\Http\Controllers\Admin\AdminUserController@is_active')->name('users.active');
        /*================Admin drivers control =========================*/
        Route::resource('drivers', 'App\Http\Controllers\Admin\AdminDriverController');
        Route::get('drivers/active/{id}', 'App\Http\Controllers\Admin\AdminDriverController@is_active')->name('drivers.active');
        Route::resource('cars', 'App\Http\Controllers\Admin\AdminCarsController');
        Route::post('cars/delete', 'App\Http\Controllers\Admin\AdminCarsController@delete')->name('cars.delete');

        Route::get('cars/active/{id}', 'App\Http\Controllers\Admin\AdminCarsController@is_active')->name('cars.active');

        Route::resource('newDrivers', 'App\Http\Controllers\Admin\AdminNewDriverController');
        Route::resource('prices', 'App\Http\Controllers\Admin\AdminPriceTimeController');
        Route::get('newDrivers/accept/{id}', 'App\Http\Controllers\Admin\AdminNewDriverController@accept_the_driver')
            ->name('newDrivers.accept');


        /*================Admin banks control =========================*/
        Route::resource('banks', 'App\Http\Controllers\Admin\AdminBankController');
        Route::resource('wallets', 'AdminWalletController');
        /*================Admin banks control =========================*/

        /*================Admin coupons control =========================*/
        Route::resource('coupons', 'App\Http\Controllers\Admin\AdminCouponsController');
        /*================Admin coupons control =========================*/
        /*================Admin payments control =========================*/
        Route::resource('payments', 'App\Http\Controllers\Admin\AdminPaymentController');
        /*================Admin payments control =========================*/

        /*================Admin Contact us control =========================*/
        Route::resource('contacts', 'App\Http\Controllers\Admin\AdminContactUsController');
        /*================Admin Contact us control =========================*/
        /*================Admin Notification Messages control =========================*/
        Route::resource('notificationMessages', 'App\Http\Controllers\Admin\AdminNotificationsMessagesController');
        /*================Admin  Notification Messages  control =========================*/


        /*=============Roles and Permissions==============================*/
        Route::resource('roles', 'App\Http\Controllers\Admin\AdminRolesController');
        Route::post('permissionForGuard', 'App\Http\Controllers\Admin\AdminRolesController@get_permission_based_on_guard_name')
            ->name('permissionForGuard');
        Route::post('permissionForGuardInEdit', 'App\Http\Controllers\Admin\AdminRolesController@get_permission_based_on_guard_nameInEdit')
            ->name('permissionForGuardInEdit');
        Route::resource('permissions', 'App\Http\Controllers\Admin\AdminPermissionsController');
        /*=============Roles and Permissions==============================*/

        Route::resource('allOrders', 'App\Http\Controllers\Admin\AdminOrderController');


        //test
        Route::get('notify', 'App\Http\Controllers\Admin\TestController@notify');


        Route::resource('terms', 'App\Http\Controllers\Admin\TermController');

        Route::patch('/drivers/{id}/updateApproval', [AdminDriverController::class, 'updateApproval'])->name('drivers.updateApproval');

        Route::patch('/users/{id}/updateApproval', [AdminUserController::class, 'updateApproval'])->name('users.updateApproval');


    });//end middleware admin
    /*====================End Admin Panel==================*/


});




