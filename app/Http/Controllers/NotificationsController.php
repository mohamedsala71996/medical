<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //mark all notifications as read
        auth()->user()->unreadNotifications->markAsRead();
        $notifications = auth()->user()->notifications;
        return view('notifications.index', ['notifications' => $notifications]);
    }

    public function show(Notification $notification)
    {
        $notification->markAsRead();
        return view('notifications.show', ['notification' => $notification]);
    }
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return redirect()->route('notifications.index');
    }
    public function destroyAll()
    {
        auth()->user()->notifications()->delete();
        return redirect()->route('notifications.index');
    }

    public function markAsRead(Notification $notification)
    {
        $notification->markAsRead();
        return redirect()->route('notifications.index');
    }

    public function markAllAsRead()
    {
        auth()->user()->unreadNotifications->markAsRead();
        return redirect()->route('notifications.index');
    }

    public function myNotifications(){
        return auth()->user()->unreadNotifications->count();
        // return view('notifications.myNotifications', ['notifications' => $notifications]);
    }
}
