<?php


namespace App\Http\Traits;


use App\Models\Notification;

trait NotificationTrait
{
    public function send_notification($notification_array){

        $notification=new Notification();
        $notification->model_type=$notification_array['model_type'];
        $notification->model_id=$notification_array['model_id'];
        $notification->from_user_id=$notification_array['from_user_id'];
        $notification->to_user_id=$notification_array['to_user_id'];
        $notification->notification_type=$notification_array['notification_type'];
        $notification->action_type=$notification_array['action_type'];
        $notification->notification_message_id=$notification_array['notification_message_id'];
        $notification->order_id=$notification_array['order_id']!=null?$notification_array['offer_id']:null;
        $notification->offer_id=$notification_array['offer_id']!=null?$notification_array['offer_id']:null;
        $notification->notification_date=date('Y-m-d H:i');
        $notification->is_read=0;
        $notification->other_message='No messsage';
        $notification->save();
        // dd($notification);

    }//end
}