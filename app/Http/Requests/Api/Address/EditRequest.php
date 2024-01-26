<?php

namespace App\Http\Requests\Api\Address;

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
        return [
            'address_1' => 'required',
            'address_2' => 'nullable',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'type' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'address_1.required' => 'A address 1 is required !',
            'address_2.required' => 'A address 2 is required !',
            'city.required' => 'A city is required !',
            'state.required' => 'A state is required !',
            'postal_code.required' => 'A postal code is required !',
            'type.required' => 'A type is required !',
        ];
    }
}
