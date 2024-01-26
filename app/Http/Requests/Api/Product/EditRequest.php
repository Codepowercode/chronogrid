<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $prod = [
            'serial_number' => 'required',
            'model_number' => 'required',
            'brand' => 'required',
            'description' => 'required',
            'model' => 'required',
            'color' => 'required',
            'size' => 'required',
            'metal' => 'required',
            'bezel_size' => 'nullable',
            'bezel_type' => 'required',
            'bezel_metal' => 'required',
            'bracelet_type' => 'nullable',
            'condition' => 'required',
            'more_condition' => 'required',
            'dial_type' => 'required',
            'year' => 'required',
            'price' => 'required',
            'note' => 'nullable',
            'auction' => 'required|boolean',
            'images' => 'nullable',
        ];
        $merge = $prod;
        //If the auction is activated
        isset($this->toArray()['auction']) ? $au = $this->toArray()['auction'] : $au = 0;
        if ((int)$au == 1){
            $auction = [
                'auction_start' => 'required',
                'auction_end' => 'required',
            ];
            $merge = array_merge($prod, $auction);
        }
        return $merge;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'brand.required' => 'A brand is required !',
            'description.required' => 'A description is required !',
            'model.required' => 'A model is required !',
            'color.required' => 'A color is required !',
            'size.required' => 'A size is required !',
            'metal.required' => 'A metal is required !',
            'bezel_size.required' => 'A bezel size is required !',
            'bezel_type.required' => 'A bezel type is required !',
            'bezel_metal.required' => 'A bezel metal is required !',
            'bracelet_type.required' => 'A bracelet type is required !',
            'band.required' => 'A band is required !',
            'dial_type.required' => 'A dial type is required !',
            'price.required' => 'A price is required !',
            'auction_start.required' => 'A auction start is required !',
            'auction_end.required' => 'A auction end is required !',
        ];
    }
}
