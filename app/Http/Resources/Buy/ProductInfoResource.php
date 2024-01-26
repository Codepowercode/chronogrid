<?php

namespace App\Http\Resources\Buy;

use App\Models\User;
use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ProductInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        dd($this->company->address);
//        $user = User::findOrFail($this->company);
        $array = [
            "id" => $this->id,
            "company" => [
                'name' =>$this->company->name,
                'email' =>$this->company->email,
                'info' =>$this->company->info,
                'address' =>$this->company->address,
            ],
            "brand" => $this->brand,
            "description" => $this->description,
            "model_number" => $this->model_number,
            "model" => $this->model,
            "color" => $this->color,
            "size" => $this->size,
            "metal" => $this->metal,
            "bezel_size" => $this->bezel_size,
            "bezel_type" => $this->bezel_type,
            "bezel_metal" => $this->bezel_metal,
            "bracelet_type" => $this->bracelet_type,
            "condition" => $this->condition,
            "more_condition" => $this->more_condition,
            "band" => $this->band,
            "dial_type" => $this->dial_type,
            "year" => $this->year,
            "quantity" => $this->quantity,
            "shipping" => $this->shipping,
            "note" => $this->note,
            "price" => $this->price,
            "min_offer_price" => $this->min_offer_price,
            "auction" => $this->auction,
            "auction_price" => $this->auction_price,
            "auction_min_bid" => $this->auction_min_bid,
            "auction_start" => $this->auction_start,
            "auction_end" => $this->auction_end,
            "status" => $this->status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "images" => isset($this->images[0]->path) ? $this->images[0]->path : '/assets/custom/img/default-img.png',
        ];
        return  $array ;
    }
}
