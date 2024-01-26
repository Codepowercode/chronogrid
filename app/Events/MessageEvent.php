<?php

namespace App\Events;

use App\Models\User;
use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $sender_id;
    public $rec_id;
    public $message;
    public $time;
    public $reply;
    public $username;

    /**
     * Create a new event instance.
     *
     * @param $sender_id
     * @param $rec_id
     * @param $msg
     * @param $time
     * @param $reply
     * @param $username
     */
    public function __construct($sender_id,$rec_id,$msg,$time, $reply, $username)
    {
        $this->sender_id = $sender_id;
        $this->rec_id = $rec_id;
        $this->time = $time;
        $this->message = $msg;
        $this->reply = $reply;
        $this->username = $username;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return[
            new PrivateChannel('chat-'.$this->sender_id),
            new PrivateChannel('chat-'.$this->rec_id)
        ];
    }

    public function broadcastAs()
    {
        return 'messageSend';
    }


}
