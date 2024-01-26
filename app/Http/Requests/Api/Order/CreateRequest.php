<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
        return [
            'product_id' => 'required',
            'buyer_id' => 'required',
            'seller_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'track_number' => 'required',
            'delivery' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
