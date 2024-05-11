<?php


namespace App\Http\interfaces;


interface UsersInterface
{

    public function createOrUpdateUsers($user,$request);
    public function active_user($user);
    public function delete_row($user);

}