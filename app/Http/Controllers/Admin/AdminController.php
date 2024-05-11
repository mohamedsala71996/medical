<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Setting;
use App\Models\User;
use App\Models\Visit;


class AdminController extends Controller
{


    /**
     * show dashboard.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['admins']=Admin::all();
        $data['today_android']=User::where('type',1)->get();
        $data['today_ios']=User::where('type',2)->get();
        return view('admin.home.dashboard')->with($data);
    }


}//end
