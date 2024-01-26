<?php

namespace App\Http\Controllers\Api;

use App\Events\ChatMessageSent;
use App\Models\Message;
use App\Models\RoomMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use App\MyHellepr\PusherHellper;


class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {

        PusherHellper::pusher('my-chat-channel', 'my-new-message-event', ['message' => $request->message]);

        // --------------------------------------------------------------------------------------------------
        // $message = $request->input('message');

        // event(new ChatMessageSent($message));

        DB::beginTransaction();
        $sender = 12;
        $recipient = 15;

        $RoomMessage = RoomMessage::query()->where('name', $request->room)->first();
        if (!isset($RoomMessage->id)){
            $messageRoom = new RoomMessage();
            $messageRoom->name = 'room:'.$sender.'/'.$recipient;
            $messageRoom->save();
        }



        $message = new Message();
        $message->room_id = isset($RoomMessage->id) ? $RoomMessage->id : $messageRoom->id;
        $message->sender_id = 1;
        $message->recipient_id = 2;
        $message->message = $request->message;
        $message->save();

        DB::commit();

        return response()->json(['message' => $message]);
    }
}
