<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=> $this->id,
            "user_id"=> $this->user_id,
            "type"=> $this->type,
            "phone_number"=> $this->phone_number,
            "alt_phone_number"=> $this->alt_phone_number,
            "website"=> $this->website,
            "company_contact"=> $this->company_contact,
            "business_hours"=> json_decode($this->business_hours),
            "trade"=> json_decode($this->trade),
            "iwjg_member_number"=> $this->iwjg_member_number,
            "rapnet_member_number"=> $this->rapnet_member_number,
            "jbt_member_number"=> $this->jbt_member_number,
            "poligon_member_number"=> $this->poligon_member_number,
            "tawd"=> $this->tawd,
            "about_company"=> $this->about_company,
            "bank_information"=> json_decode($this->bank_information),
            "created_at"=> $this->created_at,
            "updated_at"=> $this->updated_at,
        ];
    }
}
