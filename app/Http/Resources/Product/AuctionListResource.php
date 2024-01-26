<?php

namespace App\Http\Resources\Product;

use App\Models\Product;
use App\Models\ProductAuction;
use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;

class AuctionListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // todo All Products
        $status = $this->auctionHistory->where('user_id', Hellper::companyId())->max('price');
        $moreCondition = Product::moreCondition($this->more_condition);
        $images = [];
        foreach ($this->images as $img){
            $images[]['path'] = $img->path;
        }

        return [
            "id" => $this->id,
            "company" => Hellper::filterUser($this->company),
            "serial_number" => $this->serial_number,
            "brand" => $this->brand,
            "description" => $this->description,
            "model_number" => $this->model_number,
            "model" => $this->model,
            "condition" => $this->condition,
            "more_condition" => $this->more_condition,
            "more_condition_box" => $moreCondition['box'],
            "more_condition_papers" => $moreCondition['papers'],
            "year" => $this->year,
            "quantity" => $this->quantity,
            "note" => $this->note,
            "price" => $this->price,
            "auction" => $this->auction,
            "auction_price" => $this->auction_price,
            "auction_min_bid" => $this->auction_min_bid,
            "auction_start" => $this->auction_start,
            "auction_end" => $this->auction_end,
            "status" => $this->status,
            "blocked_product" => $this->blocked_product,
            "status_position" => $this->status_position,
            "images" => $images,
            'bid_auth_user_price' => isset($status) ? $status : '0',
        ];
    }
}
