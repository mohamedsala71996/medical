<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\DestroyModelRow;
use App\Http\Traits\Upload_Files;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminSlidersController extends Controller
{
    use DestroyModelRow,Upload_Files;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders=Slider::latest()->get();
        return view('admin.slider.index')->with(['sliders'=>$sliders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'en_title' => 'nullable|string',
            'ar_title' => 'nullable|string',
            'type' => 'required|in:0,1',
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
        ]);

        $data['image']=$request->hasFile('image')
        ?$this->uploadFiles('sliders',$request->image,null):'';

        Slider::create($data);
        toastr()->success('تمت العملية بنجاح','تهانينا');
        return redirect()->route('sliders.index');
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
    public function destroy(Slider $slider)
    {
        Storage::delete('uploads/'.$slider->image);
        $this->destroy_row($slider);
    }
}
