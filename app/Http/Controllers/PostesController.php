<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PostesController extends Controller
{
    public function __construct()
    {


        //some functions can only be executed by group admin/owner
        $this->middleware('auth')->only(['edit', 'update', 'delete', 'create' ,'store']);
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    }
    public function index()
    {
        if (auth()->user()->terms == true) {
            $data['posts']=Post::orderBy('id','desc')->with('comments')->get();
            return view('site.home.index', $data);
        
        } else {
            return view('site.home.terms');
        }


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
        $this->validate($request,[
            'body' => 'required',
        ]);

        $s= new Post();
       $s->user_id=auth()->user()->id;
       $s->body=$request->body;
       $s->save();
       return back();
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
}
