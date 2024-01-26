<?php

namespace App\Http\Requests\Backend\Company;

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
//        dd($this->company_info_id);
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$this->company_id,
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
            'name.required' => 'A name is required !',
            'email.required' => 'A email is required !',
            'email.unique' => 'email.unique',
            'subscription_id.required' => 'A subscription is required !',
            'subscription_card.required' => 'A subscription card is required !',
            'address1.required' => 'A address1 is required !',
            'city.required' => 'A city is required !',
            'state.required' => 'A state is required !',
            'postal_code.required' => 'A postal code is required !',
        ];
    }
}
