<?php

namespace App\Http\Resources\Product;

use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductAuctionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this->status){
            $status = [
                "id" => $this->id,
                "company" => '',
                "product_id" => $this->product_id,
                "price" => $this->price,
                "status" => 'private',
                "product" => new ProductResource($this->product),
            ];
        }else{
            $status = [
                "id" => $this->id,
                "company" => Hellper::filterUser($this->company),
                "product_id" => $this->product_id,
                "price" => $this->price,
                "status" => 'public',
                "product" => new ProductResource($this->product),
            ];
        }
//        dd($status);

        return $status;
    }
}
