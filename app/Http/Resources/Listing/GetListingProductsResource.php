<?php

namespace App\Http\Resources\Product;

use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;

class GetListingProductsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "company" => Hellper::filterUser($this->company),
            "product_id" => $this->product->id,
            "price" => $this->price,
            "status" => 'public',
        ];
    }
}
