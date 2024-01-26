<?php


namespace App\MyHellepr;


use Pusher\Pusher;

class PusherHellper
{

    public function pusher($channel, $event, $data = [])
    {
        $return_data = [
            'status' => false, 
            'response_code' => 0, 
            'message'=>'oops'
        ];
       

        $options = [
            'cluster' => env('PUSHER_APP_CLUSTER'),
            'useTLS' => true
        ];

        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );

        $response = $pusher->trigger($channel, $event, $data);

        if($response){
            $return_data = [
                'status' => true, 
                'response_code' => 1, 
                'message'=>'Success.'
            ];
        }
        return $return_data;
    }

}
