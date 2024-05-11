<?php


namespace App\Http\repositories;


use App\Models\Admin;
use App\Http\interfaces\AdminInterface;
use App\Http\Traits\AdminControllerFun;
use App\Http\Traits\Upload_Files;

class AdminRepository implements AdminInterface
{

    //my {{asset('admin')}}/assets/
    use Upload_Files;
    use AdminControllerFun;

    /**
     * @return All admins
     */
    public function allAdminsWithoutCurrentAuth()
    {
        $admins=Admin::where('id','!=',\admin()->user()->id)
            ->orderBY('created_at','desc')
            ->get();
        return $admins;
    }
    /**
     * @return create
     */
    public function store_new_admin($request)
    {
        //encrypt password
        $request->merge([
            'password' =>bcrypt($request->password),
        ]);
        //create new row
        $this->create_new_admin($request);
        //return
    }

    /**
     * @return Update
     */
    public function update_admin_row($admin,$request)
    {
        //check password
        $this->password_check($admin,$request);
        //update row
        $this->update_admin($admin,$request);
    }

    /**
     * @return delete
     */
    public function delete_admin_row($admin)
    {
        $good=$admin->delete();
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);
    }

}//end class