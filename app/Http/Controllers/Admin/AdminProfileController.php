<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\interfaces\AdminInterface;
use App\Http\Requests\UpdateAdmin;
use App\Rules\UpdatedUniqueAttribute;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminProfileController extends Controller
{

    protected $repository;


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
    public function edit($id)
    {
        $admin=Admin::findOrFail($id);
        return view('admin.admin_profile.edit')->with(['admin'=>$admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdmin $request, $id)
    {
        $admin=Admin::findOrFail($id);
        //more validation
        $this->validate($request, [
            'email' =>new UpdatedUniqueAttribute('email',$admin),
        ]);
        //update
        $this->repository->update_admin_row($admin,$request);
        toastr()->success('تمت العملية بنجاح !','تهانينا');
        return redirect(route('admin.dashboard'));
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

    /**
     * Update pass view
     *
     *
     */

    public function update_pass_view($id)
    {
        $admin=Admin::findOrFail($id);
        return view('admin.admin_profile.change_pass')->with(['admin'=>$admin]);
    }

    /**
     * Update pass action
     *
     *
     */


    public function update_pass(Request $request)
    {
        //validate
        $this->validate($request,[
            'password' => 'required|string|max:191|confirmed',
        ]);
        //update pass
        $admin=Admin::findOrFail($request->id);
        $admin->password=$request->password!=null?bcrypt($request->password):$admin->password;
        $admin->save();

        toastr()->success('تمت العملية بنجاح !','تهانينا');
        return redirect(route('admin.dashboard'));
    }//end fun

}//end class
