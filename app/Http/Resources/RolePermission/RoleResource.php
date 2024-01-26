<?php

namespace App\Http\Resources\RolePermission;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [];
        foreach ($this->permissions as $item){
            $data[] = [
                'id' => $item->id,
                'name' => $item->name,
            ];
        }
        return [
            'id' => $this->id,
            'name' => $this->company_roles_name,
            'permissions' => $data
        ];
    }
}
