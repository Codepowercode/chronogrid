<?php


namespace App\MyHellepr;


use App\Models\UserEvanet;

class NotificationHellper
{

    public function notification($user_id, $type, $action, $additional_id,	$is_read = 0, $status = null)
    {
        $notification = new UserEvanet();
        $notification->user_id = $user_id;
        $notification->type = $type;
        $notification->action = $action;
        $notification->additional_id = $additional_id;
        $notification->is_read = $is_read;
        $notification->status = $status;
        if ($notification->save()) {
            return [
                'status' => true,
                'notification' => $notification,
            ];
        }

        return [
            'status' => false,
            'notification' => null,
        ];

    }

}
