<?php

namespace App\Http\Requests\Api\Listing;

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
            'brand' => 'required',
            'model' => 'required',
            'metal' => 'required',
            'description' => 'required',
            'description1' => 'required',
            'full_description' => 'required',
            'model_text' => 'required',
            'model_description' => 'required',
            'size' => 'required',
            'bezel_material' => 'required',
            'bezel_type' => 'required',
            'bezel_size' => 'nullable',
            'band_material' => 'required',
            'band_type' => 'required',
            'dial' => 'required',
            'dial_markers' => 'required',
            'retail' => 'required',

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
            'brand.required' => 'A [ Brand ] is required !',
            'model.required' => 'A [ Model ] is required !',
            'metal.required' => 'A [ Metal ] is required !',
            'description.required' => 'A [ Description ] is required !',
            'description1.required' => 'A [ Description1 ] is required !',
            'full_description.required' => 'A [ Full description ] is required !',
            'model_text.required' => 'A [ Model text ] is required !',
            'model_description.required' => 'A [ Model description ] is required !',
            'size.required' => 'A [ Full size ] is required !',
            'bezel_material.required' => 'A [ Bezel material ] is required !',
            'bezel_type.required' => 'A [ Bezel type ] is required !',
            // 'bezel_size.required' => 'A [ Bezel size ] is required !',
            'band_material.required' => 'A [ Band material ] is required !',
            'band_type.required' => 'A [ Band type ] is required !',
            'dial.required' => 'A [ Dial ] is required !',
            'dial_markers.required' => 'A [ Dial markers ] is required !',
            'retail.required' => 'A [ Retail ] is required !',
        ];
    }
}
