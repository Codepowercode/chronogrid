<?php

namespace App\Http\Resources\Product;

use App\Models\Product;
use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyAuctionBiddedListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $moreCondition = Product::moreCondition($this->more_condition);
        $images = [];
        foreach ($this->product->images as $img){
            $images[]['path'] = $img->path;
        }

        $status = [
            "id" => $this->id,
            "company" => Hellper::filterUser($this->company),
            "product_id" => $this->product_id,
            "price" => $this->price,
            "status" => 'public',
            'product' => [
                "id" => $this->product->id,
                "company" => Hellper::filterUser($this->company),
                "serial_number" => $this->product->serial_number,
                "brand" => $this->product->brand,
                "description" => $this->product->description,
                "model_number" => $this->product->model_number,
                "model" => $this->product->model,
                "condition" => $this->product->condition,
                "more_condition" => $this->product->more_condition,
                "more_condition_box" => $moreCondition['box'],
                "more_condition_papers" => $moreCondition['papers'],
                "year" => $this->product->year,
                "quantity" => $this->product->quantity,
                "note" => $this->product->note,
                "price" => $this->product->price,
                "auction" => $this->product->auction,
                "auction_price" => $this->product->auction_price,
                "auction_min_bid" => $this->product->auction_min_bid,
                "auction_start" => $this->product->auction_start,
                "auction_end" => $this->product->auction_end,
                "status" => $this->product->status,
                "images" => $images
            ]
        ];

        return $status;
    }
}
