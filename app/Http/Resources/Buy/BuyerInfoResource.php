<?php

namespace App\Http\Resources\Buy;

use App\Models\User;
use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class BuyerInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        dd($this);
//        $user = User::findOrFail($this->company);
        return [
            'name' =>$this->name,
            'email' =>$this->email,
            'info' =>$this->info,
            'address' =>$this->address,
        ];
    }
}
