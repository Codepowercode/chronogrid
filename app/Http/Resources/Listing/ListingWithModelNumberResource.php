<?php

namespace App\Http\Resources\Listing;

use App\MyHellepr\Hellper;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ListingWithModelNumberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // todo Product By ID
        return [
            "id" => $this->id,
            "brand" => $this->brand,
            "model" => $this->model,
            "metal" => $this->metal,
            "description" => $this->description,
            "description1" => $this->description1,
            "full_description" => $this->full_description,
            "model_text" => $this->model_text,
            "model_description" => $this->model_description,
            "size" => substr($this->size, 0, -2),
            "bezel_material" => $this->bezel_material,
            "bezel_type" => $this->bezel_type,
            "bezel_size" => substr($this->bezel_size, 0, -2),
            "band_material" => $this->band_material,
            "band_type" => $this->band_type,
            "dial" => $this->dial,
            "dial_markers" => $this->dial_markers,
            "retail" => $this->retail,
            "path" => Str::replaceFirst('/public', '',$this->path),
            "year" => $this->year,
        ];
    }
}
