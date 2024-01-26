<?php

namespace App\Http\Resources\Listing;

use App\Models\Product;
use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ListingsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|
     */
    public function toArray($request)
    {
        // todo All Products
        return [
            "id" => $this->id,
            "brand" => $this->brand,
            "description" => $this->description,
            "model" => $this->model,
            "year" => $this->year,
            "path" => Str::replaceFirst('/public/', '',$this->path),
            "count_product" => Product::where('status', 1)->where('model_number', $this->description)->count(),
            "min_price_product" => Product::where('status', 1)->where('model_number', $this->description)->min('price'),
        ];
    }
}
