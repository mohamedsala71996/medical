<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminThemeController extends Controller
{
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
    public function destroy($id)
    {
        //
    }

    /**
     *
     * @param
     * @return \Illuminate\Http\Response
     *
     * Change Slider Color
     */
    public function changeSliderColor(Request $request)
    {
        $admin=Admin::findOrFail(\admin()->user()->id);
        $admin->slider_theme=$request->slider_color;
        $admin->save();
        return response(1);
    }
    /**
     *
     * @param
     * @return \Illuminate\Http\Response
     *
     * Change header Color
     */
    public function changeHeaderColor(Request $request)
    {
        $admin=Admin::findOrFail(\admin()->user()->id);
        $admin->header_theme=$request->header_theme;
        $admin->save();
        return response(1);
    }

}//end class
