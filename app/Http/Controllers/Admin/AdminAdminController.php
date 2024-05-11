<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\interfaces\AdminInterface;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\UpdateAdmin;
use App\Rules\UpdatedUniqueAttribute;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Scalar;


class AdminAdminController extends Controller
{




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.admins.index')
            ->with([
                'admins'=>Admin::where('id','!=',auth('admin')
                    ->user()->id)
                    ->latest()
                    ->get()
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminRequest $request)
    {
        $this->repository->store_new_admin($request);
        toastr()->success('تمت العملية بنجاح !','تهانينا');
        return redirect(route('admins.index'));
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
    public function edit(Admin $admin)
    {
        return view('admin.admins.edit')->with(['admin'=>$admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdmin $request,Admin $admin)
    {
        //more validation
        $this->validate($request, [
            'email' =>new UpdatedUniqueAttribute('email',$admin),
        ]);
        //update
        $this->repository->update_admin_row($admin,$request);
        toastr()->success('تمت العملية بنجاح !','تهانينا');
        return redirect(route('admins.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $this->repository->delete_admin_row($admin);
    }


}//end
