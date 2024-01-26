<?php

namespace App\Http\Resources\Order;

use App\Http\Resources\Product\ProductMyAuctionBidResource;
use App\Http\Resources\User\UserEventsResource;
use App\Models\UserEvanet;
use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchasesHistory extends JsonResource
{
    /**1
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        dd(get_class($this->first()));
//        dd($this);

        $user_events = UserEvanet::query()
            ->whereIn('user_id', [Hellper::apiAuth()->id, Hellper::companyId()])
            ->whereIn('additional_id', [$this->id, $this->offer_id])
            ->whereIn('type', ['order', 'offer'])->get();

//        dd($this->id, $user_events);
        $x = [
            "id" => $this->id,
            "product_id" => 3,
            "buyer_id" => Hellper::filterUserResource($this->buyer_id),
            "seller_id" => Hellper::filterUserResource($this->seller_id),
            "quantity" => $this->quantity,
            "price" => $this->price,
            "track_number" => $this->track_number,
            "delivery" => $this->delivery,
            "history" => $this->history,
            "label" => $this->pdf,
            "shipping" => $this->shipping,
            "original_price" => $this->original_price,
            "auction" => $this->auction,
            "status" => $this->status,
            "transfer_status" => $this->transfer_status,
            "canceled_user_id" => $this->canceled_user_id,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "offer_id" => $this->offer_id,
            "events" => UserEventsResource::collection($user_events),
            "product" => [
                    "id" => $this->product->id,
                    "company" => Hellper::filterUserResource($this->product->user_id),
                    "brand" => $this->product->brand,
                    "description" => $this->product->description,
                    "model_number" => $this->product->model_number,
                    "model" => $this->product->model,
                    "color" => $this->product->color,
                    "size" => $this->product->size,
                    "metal" => $this->product->metal,
                    "bezel_size" => $this->product->bezel_size,
                    "bezel_type" => $this->product->bezel_type,
                    "bezel_metal" => $this->product->bezel_metal,
                    "bracelet_type" => $this->product->bracelet_type,
                    "condition" => $this->product->condition,
                    "more_condition" => $this->product->more_condition,
                    "band" => $this->product->band,
                    "dial_type" => $this->product->dial_type,
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
                    "images" => $this->product->images,
            ]
        ];
        return $x;
    }
}
