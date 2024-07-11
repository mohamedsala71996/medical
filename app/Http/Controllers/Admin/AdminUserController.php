<?php

namespace App\Http\Controllers\Admin;

use App\Http\interfaces\UsersInterface;
use App\Http\Requests\InsertUser;
use App\Http\Requests\UpdateUser;

use App\Http\Traits\Location;
use App\Models\Country;
use App\Rules\UpdatedUniqueAttribute;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\CityModel;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{

    use Location;

    protected $repository;



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type',1)->latest()->get();
        return view('admin.users.index')->with(['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     /*   $data = $this->createMap();*/
        /*$cities=CityModel::get();*/
        return view('admin.users.create')
            ->with([
              /*  'maps' => $data['maps'],*/
               /* 'cities'=>$cities,*/
                'codes'=>Country::where('is_show', 1)->get()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsertUser $request,User $user)
    {
        $this->repository->createOrUpdateUsers($user,$request);
        toastr()->success('تمت العملية بنجاح !','تهانينا');
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::findOrFail($id);
       /* $data = $this->createMap($zoom = 6,$user->latitude,$user->longitude,false);*/
        return view('admin.users.show',['user'=>$user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
       /* $data = $this->createMap($zoom = 6,$user->latitude,$user->longitude,true);*/
        /*$cities=CityModel::get();*/
        return view('admin.users.edit')
            ->with([
                'user'=>$user,
               /* 'maps' => $data['maps'],*/
               /* 'cities'=>$cities,*/
                'codes'=>Country::where('is_show', 1)->get()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        $this->validate($request,[
            'email'=>new UpdatedUniqueAttribute('email',$user),
            'phone' =>new UpdatedUniqueAttribute('phone',$user),
        ]);
        $this->repository->createOrUpdateUsers($user,$request);
        //----------------return-------------------
        toastr()->success('تمت العملية بنجاح !','تهانينا');
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       $this->repository->delete_row($user);
    }

    /**
     * change the activation status
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function is_active($id)
    {
       $user=User::findOrFail($id);
       if ($user->is_bloked==0){
           $user->is_bloked=1;
           $user->save();
       }else{
           $user->is_bloked=0;
           $user->save();
       }
        toastr()->success('تمت العملية بنجاح !','تهانينا');
        return redirect(route('users.index'));
    }//end


    public function updateApproval(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->is_approved = $request->input('is_approved');
    $user->save();

    return redirect()->back()->with('success', 'تم تحديث حالة المستخدم بنجاح');
}

}//end class
