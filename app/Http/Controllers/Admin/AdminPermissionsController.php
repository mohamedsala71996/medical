<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\DestroyModelRow;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class AdminPermissionsController extends Controller
{
    use DestroyModelRow;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions=Permission::get();
        return view('admin.permissions.index',['permissions'=>$permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guards=collect(config('auth.guards'))->forget('api');
        return view('admin.permissions.create',['guards'=>$guards]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        request()->validate([
            'name'=> 'required|max:255',
            'guard_name'  => [
                'required',
                Rule::unique('permissions')->where(function ($query) use ($request) {
                    return $query
                        ->whereName($request->name)
                        ->whereGuardName($request->guard_name);
                }),
            ],
        ],
            [
                'guard_name.unique' => __('messages.permission.error.unique', [
                    'name'=> $request->name,
                    'guard_name'     => $request->guard_name
                ]),
            ]);
        Permission::create($request->all());
        toastr()->success('تمت العملية بنجاح !','تهانينا');
        return redirect()->route('permissions.index');
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
    public function edit(Permission $permission)
    {
        $guards=collect(config('auth.guards'))->forget('api');
        return view('admin.permissions.edit',['guards'=>$guards,'permission'=>$permission]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        request()->validate([
            'name'=>'required|max:255',
            'guard_name'  => [
                'required',
                Rule::unique('permissions')->where(function ($query) use ($request, $permission) {
                    return $query
                        ->whereName($request->name)
                        ->whereGuardName($request->guard_name)
                        ->whereNotIn('id', [$permission->id]);
                }),
            ],
        ],
            [
                'guard_name.unique' => __('messages.permission.error.unique', [
                    'name' => $request->name,
                    'guard_name'      => $request->guard_name
                ]),
            ]);
        $permission->update($request->all());
        toastr()->success('تمت العملية بنجاح !','تهانينا');
        return redirect()->route('permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        if ($permission->name=='make roles and permission'){
            return response(['error'=>1]);
        }
        $this->destroy_row($permission);
    }
}
