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
        $data['users']=User::where('type',1)->get();
        $data['docs']=User::where('type',2)->get();
        $data['nutrition']=User::where('type',3)->get();
        return view('admin.home.dashboard')->with($data);
    }


}//end
