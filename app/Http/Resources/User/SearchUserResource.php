<?php

namespace App\Http\Resources\User;

use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchUserResource extends JsonResource
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
            'rating' => Hellper::filterUserResource($this->id)['rating'],
        ];
    }
}
