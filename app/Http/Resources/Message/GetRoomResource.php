<?php

namespace App\Http\Resources\Message;

use App\Models\Message;
use App\Models\User;
use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class GetRoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $auth = Hellper::companyId();
        $user_id = $auth == $this->to_id ? $this->from_id : $this->to_id;
        $user = Hellper::userWithId($user_id);
        $firstMessage = Message::query()->where('room_id', $this->id)->orderBy('id', 'DESC')->get();

        $firstMessagefirst = $firstMessage->first();
   
        if(!isset($firstMessagefirst->from_id) || $auth == $firstMessagefirst->from_id){
            $read = 0;
        }else{
            $read = $firstMessage->where('read', 0)->count();
        }
        return [
            "id" => $this->id,
            "name" => $this->name,
            "from_id" => $this->from_id,
            "to_id" => $this->to_id,
            'user' => $user,
            'dont_read_count' => $read,
            'first_message' => new GetMessageResource($firstMessage->first())
        ];
    }
}
