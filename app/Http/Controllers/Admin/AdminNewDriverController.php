<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\DestroyModelRow;
use App\Http\Traits\Location;
use App\Models\User;
use Illuminate\Http\Request;

class AdminNewDriverController extends Controller
{
    use Location,DestroyModelRow;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = User::DriverGet()
            ->where('is_accepted','new')
            ->latest()
            ->get();
        return view('admin.new-drivers.index',compact('drivers'));
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
        $driver=User::findOrFail($id);
/*        $data = $this->createMap($zoom = 6,$driver->latitude,$driver->longitude,false);*/
        return view('admin.new-drivers.show',['driver'=>$driver]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function accept_the_driver($id)
    {
        User::findOrFail($id)->update(['is_accepted'=>'accepted']);
        toastr()->success('تمت العملية بنجاح !','تهانينا');
        return redirect()->route('newDrivers.index');
    }
}
