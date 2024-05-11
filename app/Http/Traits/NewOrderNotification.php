<?php


namespace App\Http\Traits;


use Pusher\Pusher;

trait NewOrderNotification
{

    public function notify($title,$message,$order_id)
    {
        $options = array(
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'encrypted' => true
        );
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $data['order_id'] = $order_id;
        $data['title'] = $title;
        $data['message'] =$message;
        $pusher->trigger('new-order-channel', 'App\\Events\\OrderEvent', $data);

    }
}