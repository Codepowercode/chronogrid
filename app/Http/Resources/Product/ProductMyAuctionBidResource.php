<?php

namespace App\Http\Resources\Product;

use App\Models\Product;
use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductMyAuctionBidResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        $status = [];
        foreach ($this->auctionHistory as $hist){
            $hist->status_winner ? $status_finish = $hist->status_winner : $status_finish = 0;

            if ($hist->status){
                $status = [
                    "id" => $hist->id,
                    "company" => '',
                    "product_id" => $this->id,
                    "price" => $hist->price,
                    "status" => 'private',

                ];
            }else{
                $status = [
                    "id" => $hist->id,
                    "company" => Hellper::filterUser($hist->company),
                    "product_id" => $this->id,
                    "price" => $hist->price,
                    "status" => 'public',
                ];
            }
        }


        $moreCondition = Product::moreCondition($this->more_condition);
        $images = [];
        foreach ($this->images as $img){
            $images[]['path'] = $img->path;
        }

//        dd($this->user_id);
//        dd(Hellper::filterUser($this->user_id));
        $product = [
            "id" => $this->id,
            "company" => Hellper::filterUser($this->user_id),
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
            "auction" => $this->auction,
            "auction_price" => $this->auction_price,
            "auction_min_bid" => $this->auction_min_bid,
            "auction_start" => $this->auction_start,
            "auction_end" => $this->auction_end,
            "status" => $this->status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "winner" => $status_finish,
            "images" => $images,
            "auction_history" => $status,
        ];

        return $product;
    }
}
