<?php


namespace App\Http\Traits\Api;


use App\Http\Traits\SMSTrait;
use App\Models\User;
use http\Env\Request;

trait ApiUserTrait
{
    use SMSTrait;

    /**
     * @param $phone_code
     * @param $phone
     * @param $message
     */

    protected function generate_confirm_code_and_send_it($phone_code,$phone,$message){
        $pos=$phone_code=='00966'?true:false;
        if($pos != false){
            $this->sendSMS($phone,$message);
        }
    }

    /**
     * @param $id
     * @return mixed
     *
     * return UserData
     */
    protected function getUser($id){
        return User::where('id',$id)->with('city','country')->firstOrFail();
    }

    /**
     *
     * get user that had the current token
     */

    public function get_user_of_current_passport_token(Request $request){
      return  $request->user();
    }



    /**
     * @param $user
     *
     * add Passport Token to return user
     */

    protected function add_passport_token_to_user($user){
        $token=$user->createToken('MyApp')-> accessToken;
        $user=$this->getUser($user->id);
        $user->token=$token;
        return $user;
    }

    /**
     * @param $user
     *
     * check if user entered data can login or not
     */

    protected function checkIfUserCanLogin($user){
        $return_data=[];

        //user is block
        if ($user->block == 1) {
            $return_data[0]=406;
            $return_data[1]='هذا المستخدم موقوف';
            return $return_data;
        }
        //user in success
        $user->is_login = 1;
        $user->save();
        $user=$this->add_passport_token_to_user($user);
        $return_data[0]=200;
        $return_data[1]=$user;
        return $return_data;
    }



}//end trait