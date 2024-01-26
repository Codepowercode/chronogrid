<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'path' => $this->path  ?? 'assets/custom/img/default-avatar.png',
            'subscription' => $this->subscription,
            'subscription_start' => $this->subscription_start,
            'info' => new UserInfoResource($this->info),
            'address' => $this->address,
            'shipping' => array_values($this->address->where('type', 'shipping')->toArray())[0] ?? null,
            'billing' => array_values($this->address->where('type', 'billing')->toArray())[0]  ?? null,
            'card' => $this->card,
        ];
    }
}
