<?php

namespace App\Http\Resources\Product;

use App\Models\Product;
use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ProductAuctionSalesResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // todo Product By ID
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
            "color" => $this->color,
            "size" => $this->size,
            "metal" => $this->metal,
            "bezel_size" => $this->bezel_size,
            "bezel_type" => $this->bezel_type,
            "bezel_metal" => $this->bezel_metal,
            "bracelet_type" => $this->bracelet_type,
            "condition" => $this->condition,
            "more_condition" => $this->more_condition,
            "more_condition_box" => $moreCondition['box'],
            "more_condition_papers" => $moreCondition['papers'],
            "band" => $this->band,
            "dial_type" => $this->dial_type,
            "year" => $this->year,
            "quantity" => $this->quantity,
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
            "images" => $images,
            "auction_bid_count" => count($this->auctionHistory),
        ];
    }
}
