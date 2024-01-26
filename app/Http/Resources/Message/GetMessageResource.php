<?php

namespace App\Http\Resources\Message;

use App\Models\User;
use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class GetMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // todo Product By ID
        return [
            "id" => $this->id,
            "room_id" => $this->room_id,
            "from_id" => Hellper::userWithId($this->from_id),
            "to_id" => Hellper::userWithId($this->to_id),
            "message" => $this->message,
            "file" => [],
            "read" => $this->read,
            "created_at" => $this->created_at,
        ];
    }
}
