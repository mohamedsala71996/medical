<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->singleton('lang',function (){
            if(session()->has('lang')){
                return session()->get('lang');
            }// session lang exist
            else{
                return 'ar';
            }
        });
		Schema::defaultStringLength(191);
        $doctors = User::where('type', 2)->get();
        View::share('doctors', $doctors);
		 view()->composer('*', function ($view)
            {

                view()->composer('*', function($view)
                {
                    if (Auth::check()) {
						$my_id = Auth::id();
                        $users = message::where('is_read', 0)->where('user_id', $my_id)->count();
                        $view->with('users', $users );
                    }else {
                        $view->with('users', 0);
                    }
                });
				view()->composer('*', function($view)
                {
                    if (Auth::check()) {
						$my_id = Auth::id();
                         $message = message::where('is_read', 0)->where(['user_id' => $my_id])->get();
                        $view->with('message', $message );
                    }
                });


            });
      view()->share('settings', Setting::first());


    }
}
