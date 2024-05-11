<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SiteTextRequest;
use App\Models\SiteText;
use Illuminate\Http\Request;

class AdminTextController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $i=0;
        $siteTexts=SiteText::latest()->get();
        $arabic='<span  class="badge badge-secondary badge-danger">عربى</span>';
        $english='<span  class="badge badge-secondary badge-info">انجليزى</span>';
        foreach ($siteTexts as $siteText){
            if ($siteText->lang=='ar'){
                $siteTexts[$i]->lang_text=$arabic;
            }else{
                $siteTexts[$i]->lang_text=$english;
            }

            $i++;
        }
        return view('admin.siteText.index')->with(['siteTexts'=>$siteTexts]);
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
    public function edit(SiteText $siteText)
    {
        return view('admin.siteText.edit')
            ->with(['siteText'=>$siteText]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SiteTextRequest $request,SiteText $siteText)
    {
        $siteText->title=$request->title;
        $siteText->content=\request('content');
        $siteText->save();
        toastr()->success('تمت العملية بنجاح','تهانينا');
        return redirect(route('siteTexts.index'));
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
}
