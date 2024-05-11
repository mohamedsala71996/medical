<?php


namespace App\Http\Traits;


trait ApiResponseTrait
{


    //using to return api response
    public function apiResponse($data,$code){
        return response($data,$code);
    }


}//end class