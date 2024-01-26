<?php

namespace App\Http\Resources\Company;

use App\Http\Resources\User\UserInfoResource;
use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Message;

class CompanyInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable
     */
    public function toArray($request)
    {
        if (Hellper::apiAuth(false)->id == $this->id){
            $name = $this->name;
//            $email = $this->email;
        }else{
            $name = $this->name . ' ('.Hellper::apiAuth(false)->name.')';
//            $email = Hellper::apiAuth(false)->email;
        }

        $message = Message::query()->where('read', 0)->where('to_id', $this->id)->count();

        $email = $this->email;
        return [
            'id' => $this->id,
            'name' => $name,
            'email' => $email,
            'path' => $this->path ?? 'assets/custom/img/default-avatar.png',
            'subscription' => $this->subscription,
            'subscription_start' => $this->subscription_start,
            'info' => new UserInfoResource($this->info),
            'address' => $this->address,
            'card' => $this->card,
            'event_count' => $this->event->count(),
            'message_count' => $message,
        ];
    }
}
