<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\DestroyModelRow;
use App\Models\Social;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminSocialController extends Controller
{
    use DestroyModelRow;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $socials=Social::latest()->get();
        return view('admin.socials.index')->with(['socials'=>$socials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.socials.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data= $request->validate([
            'title' => 'required|string',
            'link' =>'required|string|max:191',

        ]);
        Social::create($data);
        toastr()->success('تمت العملية بنجاح !','تهانينا');
        return redirect(route('socials.index'));

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
    public function edit(Social $social)
    {
        return view('admin.socials.edit')->with(['social'=>$social]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Social $social)
    {
        $data=$this->validate($request,[
            'title' => 'required|string',
            'link' =>'required|string|max:191',

        ]);
        $social->update($data);
        toastr()->success('تمت العملية بنجاح !','تهانينا');
        return redirect(route('socials.index'));
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

    public function delete(Request $request)
    {
        $this->destroy_row(Social::findOrFail($request->id));
    }

}
