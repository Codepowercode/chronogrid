<?php

namespace App\Http\Resources\Order\Offer;

use App\Http\Resources\Product\ProductMyAuctionBidResource;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\User\UserEventsResource;
use App\Models\UserEvanet;
use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;

class GetOffers extends JsonResource
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
        $user_events = UserEvanet::query()->whereIn('user_id', [Hellper::apiAuth()->id, Hellper::companyId()])->where('type', 'offer')->where('additional_id', $this->id)->get();
        $x = [
            "id" => $this->id,
            "buyer_id" => Hellper::filterUserResource($this->buyer_id),
            "seller_id" => Hellper::filterUserResource($this->seller_id),
            "type" => $this->type,
            "credit" => $this->credit,
            "address" => $this->address,
            "price" => $this->price,
            "quantity" => $this->quantity,
            "count_offer" => $this->count_offer,
            "message" => $this->message,
            "shipping" => $this->shipping,
            "delivery" => $this->delivery,
            "status" => $this->status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "order" => $this->order,
            "product" => new ProductResource($this->product),
            "events" => UserEventsResource::collection($user_events),
//            "events" => $user_events,
        ];
        return $x;
    }
}


