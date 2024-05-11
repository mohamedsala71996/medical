<?php


namespace App\Http\interfaces;


interface AdminInterface
{

    public function allAdminsWithoutCurrentAuth();
    public function store_new_admin($request);
    public function update_admin_row($admin,$request);
    public function delete_admin_row($admin);


}