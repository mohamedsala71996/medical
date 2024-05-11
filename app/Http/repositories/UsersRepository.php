<?php


namespace App\Http\repositories;



use App\Http\interfaces\UsersInterface;
use App\Http\Traits\Location;
use App\Http\Traits\Upload_Files;

class UsersRepository implements UsersInterface
{
    use Location;
    use Upload_Files;

    /**
     * @param $user
     * @param $request
     * user insert or update
     */

    public function createOrUpdateUsers($user, $request)
    {
        $logo=null;
        $pass=null;
        if ($user->logo){
            $logo=$user->logo;
        }
        if ($user->password){
            $pass=$user->password;
        }
        $user->name=$request->name;
        $user->password=$request->password!=null?bcrypt($request->password):$pass;
        $user->phone=$request->phone;
        $user->email=$request->email;
       /* $user->gender=$request->gender;
        $user->latitude=$request->latitude;
        $user->longitude=$request->longitude;
        $user->city_id=$request->city_id;
        $user->country_id=$request->country_id;
        $user->address=$this->get_address_from_lat_long($request->longitude,$request->latitude);*/
        $user->software_type=3;
        $user->block=0;
        $user->is_confirmed=1;
        $user->phone_code=$request->phone_code;
        $user->logo=$this->uploadFiles('users',$request->file('logo'),$logo);
        $user->save();
    }


    /**
     * @param $user
     */
    public function active_user($user)
    {
        // TODO: Implement active_user() method.
        if ($user->block==1){
            $user->block=0;
        }else if ($user->block==0){
            $user->block=1;
        }
        $user->save();
    }

    /**
     * @param $user
     */

    public function delete_row($user)
    {
        // TODO: Implement delete_row() method.

        $good= $user->delete();
        if ($good)
            return response(['error'=>0]);
        else
            return response(['error'=>1]);
    }


}//end class