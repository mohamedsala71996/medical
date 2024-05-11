<?php


namespace App\Http\Traits;


use App\Models\Admin;

trait AdminControllerFun
{
    /**
     * create row function
     *
     */
    protected function create_new_admin($request)
    {
        Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>$request->password,
            'image'=>$this->uploadFiles('admins',$request->file('image'),null),
            'admin_type'=>0,
        ]);
    }

    /**
     * create row function
     *
     */
    protected function update_admin($admin,$request)
    {
        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'password'=>$request->password,
            'image'=>$this->uploadFiles('admins',$request->file('image'),$admin->image),
            'admin_type'=>0,
        ]);
    }

    /**
     * check password
     *
     */
    protected function password_check($admin,$request){
        if ($request->password!=null){
            $request->merge([
                'password' =>bcrypt($request->password),
            ]);
        }else{
            $request->merge([
                'password' => $admin->password,
            ]);
        }
    }


}//end trait