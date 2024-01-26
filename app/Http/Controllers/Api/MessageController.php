<?php

namespace App\Http\Controllers\Api;

use App\Events\ChatGroupEvent;
use App\Events\MessageEvent;
use App\Events\MyEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\Message\GetMessageResource;
use App\Http\Resources\Message\GetRoomResource;
use App\Http\Resources\User\SearchUserResource;
use App\Models\Message;
use App\Models\RoomMessage;
use App\Models\User;
use App\MyHellepr\Hellper;
use App\MyHellepr\PusherHellper;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use Illuminate\Support\Facades\DB;
use Pusher\Pusher;
use Carbon\Carbon;

class MessageController extends Controller
{

    /**
     * @param $room_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMessages($room_id)
    {
        $messages = Message::query()->where('room_id', $room_id)->get();
        $auth = Hellper::companyId();
        foreach($messages as $message){
            if($auth == $message->to_id){
                $message->update([
                    'read' => 1
                ]);
            }
        }
        return response()->json(GetMessageResource::collection($messages), 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendMessage(Request $request)
    {

        DB::beginTransaction();

        $get = RoomMessage::query()->findOrFail($request->room_id);
        $from_id = Hellper::companyId();

        $chanel = 'message-chanel-'.$get->from_id.'-'.$get->to_id;
        $event = 'message-event-'.$get->from_id.'-'.$get->to_id;

        $message = new Message();
        $message->room_id = $request->room_id;
        $message->from_id = $from_id; // from
        $message->to_id = $get->to_id == $from_id ? $get->from_id : $get->to_id;  //to
        $message->message = $request->message;
        $message->read = 0;
        $message->save();

        PusherHellper::pusher($chanel, $event, new GetMessageResource($message));

        DB::commit();

        return response()->json(new GetMessageResource($message), 200);
    }


     public function getUser($search)
     {
        $auth_user = Hellper::companyId();
         $user = User::query()->where('company', 1)->where('id', '!=', $auth_user)->where('name', 'like' , '%'. $search . '%')->get();

         return response()->json( SearchUserResource::collection($user), 200);
     }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRooms()
    {
        $user_id = Hellper::companyId();
        $get = RoomMessage::query()->where('from_id', $user_id)->orWhere('to_id', $user_id)->get();

        // dd($get);
        return response()->json(GetRoomResource::collection($get), 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createRoom(Request $request)
    {
        DB::beginTransaction();
                $from = Hellper::companyId();
                

                $roomValidate = RoomMessage::query()->where('from_id', $from)->where('to_id', $request->to_id)->first();

                if($roomValidate){
                    DB::commit();
                    return response()->json(new GetRoomResource($roomValidate), 200);
                }

                $room = RoomMessage::query()->create([
                    'name' => 'message-chanel-'.$from.'-'.$request->to_id,
                    'from_id' => $from,
                    'to_id' => $request->to_id,
                ]);
        DB::commit();

        return response()->json(new GetRoomResource($room), 200);
    }

    /**
     * @param $room_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteRoom($room_id)
    {
        $roomValidate = RoomMessage::query()->findOrFail($room_id)->delete();

        return response()->json('deleted room', 200);
    }




}
