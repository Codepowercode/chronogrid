<?php

namespace App\Http\Resources\Order\Excel;

use App\Http\Resources\Product\ProductMyAuctionBidResource;
use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchasesHistoryResources extends JsonResource
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
//        $x = [
//            "id" => $this->id,
//            "buyer_name" => Hellper::filterUserResource($this->buyer_id)['name'],
//            "buyer_email" => Hellper::filterUserResource($this->buyer_id)['email'],
//            "seller_name" => Hellper::filterUserResource($this->seller_id)['name'],
//            "seller_email" => Hellper::filterUserResource($this->seller_id)['email'],
//            "quantity" => $this->quantity,
//            "price" => $this->price,
//            "original_price" => $this->original_price,
//            "type" => $this->type,
//            "pdf" => $this->pdf,
//            "shipping" => $this->shipping,
//            "track_number" => $this->track_number,
//            "delivery" => $this->delivery,
//            "history" => $this->history,
//            "auction" => $this->auction,
//            "status" => $this->status,
//            "canceled_user_id" => $this->canceled_user_id,
//            "created_at" => $this->created_at,
//            "updated_at" => $this->updated_at,
//            "product_id" => $this->product->id,
//            "product_company_name" => Hellper::filterUserResource($this->product->user_id)['name'],
//            "product_brand" => $this->product->brand,
//            "product_description" => $this->product->description,
//            "product_model_number" => $this->product->model_number,
//            "product_model" => $this->product->model,
//            "product_color" => $this->product->color,
//            "product_size" => $this->product->size,
//            "product_metal" => $this->product->metal,
//            "product_bezel_size" => $this->product->bezel_size,
//            "product_bezel_type" => $this->product->bezel_type,
//            "product_bezel_metal" => $this->product->bezel_metal,
//            "product_bracelet_type" => $this->product->bracelet_type,
//            "product_condition" => $this->product->condition,
//            "product_more_condition" => $this->product->more_condition,
//            "product_band" => $this->product->band,
//            "product_dial_type" => $this->product->dial_type,
//            "product_year" => $this->product->year,
//            "product_quantity" => $this->product->quantity,
//            "product_note" => $this->product->note,
//            "product_price" => $this->product->price,
//            "product_auction" => $this->product->auction,
//            "product_auction_price" => $this->product->auction_price,
//            "product_auction_min_bid" => $this->product->auction_min_bid,
//            "product_auction_start" => $this->product->auction_start,
//            "product_auction_end" => $this->product->auction_end,
//            "product_status" => $this->product->status,
//        ];
//        return $x;
    }
}
