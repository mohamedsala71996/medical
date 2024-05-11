<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\DestroyModelRow;
use App\Http\Traits\Upload_Files;
use App\Models\NotificationMessage;
use Illuminate\Http\Request;

class AdminNotificationsMessagesController extends Controller
{
    use Upload_Files,DestroyModelRow;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notificationMessages=NotificationMessage::get();
        return view('admin.notification-messages.index',compact('notificationMessages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notification-messages.create');
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
            'ar_title'=>'required|string|min:1|max:191',
            'en_title'=>'required|string|min:1|max:191',
            'ar_desc'=>'required|string|min:1|max:191',
            'en_desc'=>'required|string|min:1|max:191',
        ]);
        NotificationMessage::create($data);
        toastr()->success('تمت العملية بنجاح','تهانينا');
        return redirect()->route('notificationMessages.index');
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
        $notificationMessage=NotificationMessage::findOrFail($id);
        return view('admin.notification-messages.edit',compact('notificationMessage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $notificationMessage=NotificationMessage::findOrFail($id);
        $data=$request->validate([
            'ar_title'=>'required|string|min:1|max:191',
            'en_title'=>'required|string|min:1|max:191',
            'ar_desc'=>'required|string|min:1|max:191',
            'en_desc'=>'required|string|min:1|max:191',
        ]);
        $notificationMessage->update($data);
        toastr()->success('تمت العملية بنجاح','تهانينا');
        return redirect()->route('notificationMessages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
