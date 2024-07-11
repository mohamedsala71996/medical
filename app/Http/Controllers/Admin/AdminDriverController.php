<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\interfaces\UsersInterface;
use App\Http\Requests\MarketRequest;
use App\Http\Requests\UpdateMarketRequest;
use App\Http\Traits\DestroyModelRow;
use App\Http\Traits\Location;
use App\Http\Traits\Upload_Files;
use App\Models\Car;
use App\Models\CityModel;
use App\Models\Country;
use App\Models\MarketBanner;
use App\Models\MarketService;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminDriverController extends Controller
{
    use Location,Upload_Files,DestroyModelRow;
    protected $repository;




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = User::
           where('type',2)->orWhere('type',3)
            ->latest()
            ->get();
        return view('admin.drivers.index',compact('drivers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       /* $data = $this->createMap();*/
       /* $cities=CityModel::get();*/
        return view('admin.drivers.create')
            ->with([
               /* 'maps' => $data['maps'],
                'cities'=>$cities,*/
                'codes'=>Country::where('is_show', 1)->get()
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarketRequest $request)
    {
        $data=$request->except('brand','model','color','licence_plate1','licence_plate2','licence_plate3','licence_plate4');
        try{
            $data['user_type']='driver';
            $data['is_accepted']='accepted';
            $data['logo']=$request->hasFile('logo')
                ?$this->uploadFiles('drivers',$request->logo,null):'';
             $data['national_image']=$request->hasFile('national_image')
                ?$this->uploadFiles('drivers',$request->national_image,null):'';

             $data['driving_license_image']=$request->hasFile('driving_license_image')
                ?$this->uploadFiles('drivers',$request->driving_license_image,null):'';
            $data['password']=$request->password==null?$request->password:bcrypt($request->password);
            $data['age']=years_between_two_date($request->birthday);

            DB::beginTransaction();
            $driver=User::create($data);
            DB::commit();
            DB::beginTransaction();
            $carData=$request->only('brand','model','color','licence_plate1','licence_plate2','licence_plate3','licence_plate4');
            $carData['licence_plate1']=$request->hasFile('licence_plate1')
                ?$this->uploadFiles('drivers',$request->licence_plate1,null):'';

            $carData['licence_plate2']=$request->hasFile('licence_plate2')
                            ?$this->uploadFiles('drivers',$request->licence_plate2,null):'';

            $carData['licence_plate3']=$request->hasFile('licence_plate3')
                ?$this->uploadFiles('drivers',$request->licence_plate3,null):'';

            $carData['licence_plate4']=$request->hasFile('licence_plate4')
                            ?$this->uploadFiles('drivers',$request->licence_plate4,null):'';
            $carData['driver_id']=$driver->id;
            $car=Car::create($carData);
            $driver=User::find($driver->id);
            $driver->is_car_validate='validate';
            $driver->car_id=$car->id;
            $driver->save();

            DB::commit();

            toastr()->success('تمت العملية بنجاح !','تهانينا');
            return redirect(route('drivers.index'));
        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->error($exception->getMessage());
            return redirect()->back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $driver=User::findOrFail($id);
/*        $data = $this->createMap($zoom = 6,$driver->latitude,$driver->longitude,false);*/
        return view('admin.drivers.show',['driver'=>$driver]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*  $data = $this->createMap();
       $cities=CityModel::get();*/

        return view('admin.drivers.edit')
            ->with([
              /*  'maps' => $data['maps'],
                'cities'=>$cities,*/
                'driver'=>User::findOrFail($id),
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
    public function update(UpdateMarketRequest $request, $id)
    {
        $data=$request->except('brand','model','color','licence_plate1','licence_plate2','licence_plate3','licence_plate4');

        $driver=User::findOrFail($id);
        try{
            $data['user_type']='driver';
            $data['logo']=$request->hasFile('logo')
                ?$this->uploadFiles('drivers',$request->logo,$driver->logo)
                :$driver->logo;
            $data['age']=years_between_two_date($request->birthday);
            $data['national_image']=$request->hasFile('national_image')
                ?$this->uploadFiles('drivers',$request->national_image,$driver->national_image):$driver->national_image;
            $data['driving_license_image']=$request->hasFile('driving_license_image')
                ?$this->uploadFiles('drivers',$request->driving_license_image,$driver->driving_license_image):$driver->driving_license_image;

            DB::beginTransaction();
            $data['password']=$request->password==null?$driver->password:bcrypt($request->password);
            $driver->update($data);
            DB::commit();
            $car=Car::find($driver->car_id);
            $carData=$request->only('brand','model','color','licence_plate1','licence_plate2','licence_plate3','licence_plate4');
            $carData['licence_plate1']=$request->hasFile('licence_plate1')
                ?$this->uploadFiles('drivers',$request->licence_plate1,$car->licence_plate1):$car->licence_plate1;

            $carData['licence_plate2']=$request->hasFile('licence_plate2')
                ?$this->uploadFiles('drivers',$request->licence_plate2,$car->licence_plate2):$car->licence_plate2;

            $carData['licence_plate3']=$request->hasFile('licence_plate3')
                ?$this->uploadFiles('drivers',$request->licence_plate3,$car->licence_plate3):$car->licence_plate3;

            $carData['licence_plate4']=$request->hasFile('licence_plate4')
                ?$this->uploadFiles('drivers',$request->licence_plate4,$car->licence_plate4):$car->licence_plate4;
            Car::find($driver->car_id)->update($carData);
            DB::commit();
            toastr()->success('تمت العملية بنجاح !','تهانينا');
            return redirect(route('drivers.index'));
        }catch (\Exception $exception){
            DB::rollBack();
            toastr()->error($exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $driver=User::findOrFail($id);
       $this->destroy_row($driver);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
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
        }        toastr()->success('تمت العملية بنجاح !','تهانينا');
        return redirect(route('drivers.index'));
    }//end

    public function updateApproval(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = $request->input('is_approved');
        $user->save();
    
        return redirect()->back()->with('success', 'تم تحديث حالة الطبيب بنجاح');
    }


}//end class

