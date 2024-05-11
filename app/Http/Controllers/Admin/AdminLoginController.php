<?php

namespace App\Http\Controllers\Admin;
use App\Models\Admin;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\Controller;
use App\Mail\AdminResetPassword;
use DB;
use Illuminate\Support\Facades\Session;
use Mail;

use Auth;

class AdminLoginController extends Controller
{
    /**
     * @Check if admin soft delete
     *
     *
     */

    public function checkIfSoftDelete($admin){
        return $admin->deleted_at!=null?true:false;
    }


    /**
     * @return
     * login view
     *
     */
    public function showLoginForm()
    {
        if (!auth('admin')->check()){
            return view('admin.auth.login');
        }
        return redirect()->route('admin.dashboard');
    }

    /**
     * @return
     * login action
     *
     */
    public function login(\Illuminate\Http\Request $request)
    {
        // Validate the form data
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:2'
        ]);
        //check the admin auth
        $rememberme = request('rememberme') == 1?true:false;
        if (admin()->attempt(['email' => request('email'), 'password' => request('password')], $rememberme)) {

            if($this->checkIfSoftDelete(admin()->user())){
                auth()->guard('admin')->logout();
                toastr()->error('Email and/or password invalid');
                return redirect()->back()->withInput($request->only('email', 'remember'));
            }
            return redirect()->route('admin.dashboard');
        }
        //invalid data
        toastr()->error('تأكد من البريد الالكترونى و كلمة المرور ');
        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    /**
     * @return
     * logout
     *
     */
    public function logout(Request $request)
    {
        \admin()->logout();
        return redirect()->route('admin.login');
    }

}//end class
