<?php


namespace App\Http\repositories;


use App\Admin;
use App\Http\interfaces\SettingInterface;
use App\Http\Traits\Upload_Files;

class SettingRepository implements SettingInterface
{

    use Upload_Files;

    public function update_setting($setting, $request)
    {
        $setting->en_title=$request->en_title;
        $setting->ar_title=$request->ar_title;
        $setting->address1=$request->address1;
        $setting->address2=$request->address2;
        $setting->phone1=$request->phone1;
        $setting->phone2=$request->phone2;
        $setting->android_app=$request->android_app;
        $setting->ios_app=$request->ios_app;
        $setting->email2=$request->email2;
        $setting->email1=$request->email1;
        $setting->logo=$this->uploadFiles('settings',$request->file('logo'),$setting->logo);
        $setting->login_banner=$this->uploadFiles('settings',$request->file('login_banner'),$setting->login_banner);
        $setting->save();
    }
}//end class