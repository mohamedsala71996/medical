<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminSettingController extends Controller
{
    use Upload_Files;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('admin.setting.setting',['setting'=>$setting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'ar_title' => 'required|string|max:191',
            'en_title' => 'required|string|max:191',
            'logo' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);

        $setting=Setting::find($id);
        $setting->en_title=$request->en_title;
        $setting->ar_title=$request->ar_title;


        /*  $setting->android_app=$request->android_app;
          $setting->ios_app=$request->ios_app;
          $setting->email2=$request->email2;
          $setting->gmail_link=$request->gmail_link;
          $setting->facebook_link=$request->facebook_link;
          $setting->tewtter_link=$request->tewtter_link;
          $setting->rss_link=$request->rss_link;
          $setting->insta_link=$request->insta_link;*/

        //upload the logo

        if ($request->logo){

            $imageName = url("upload/{$setting->logo}"); // get previous image from folder
            if (File::exists($imageName)) { // unlink or remove previous image from folder
                unlink($imageName);
            }

            $image = $request->file('logo');
            $imageName = time() . '.' .\request('logo')->getClientOriginalExtension();
            $setting->logo = 'setting/'.$imageName;
            $image->move('upload/setting', $imageName);
        }




        $setting->save();
        toastr()->success('تمت العملية بنجاح','تهانينا');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
