<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserEventsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable
     */
    public function toArray($request)
    {

        $array1 = [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'type' => $this->type,
            'action' => $this->action,
//            'history_changes' => json_decode($this->long_text),
            'send_mail' => $this->send_mail,
            'additional_id' => $this->additional_id,
            'is_read' => $this->is_read,
            'created_at' => $this->created_at,
        ];

        $array2 = [
            'status' => $this->status,
        ];

        if ($this->status == 0){
            $output = array_merge($array1, $array2);
        }
        else{
            $output = $array1;
        }


        return $output;
    }
}
