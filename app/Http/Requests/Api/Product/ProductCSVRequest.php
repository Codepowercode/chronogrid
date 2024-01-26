<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductCSVRequest extends FormRequest
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
            'import_file' => 'nullable|file',
            'import_file_zip' => 'nullable|file',
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
            'import_file.required' => 'A fail is required !',
            'import_file.mimes.csv' => 'Format File is not true! csv, xlsx',
            'import_file.mimes.xlsx' => 'Format File is not true! csv, xlsx',
        ];
    }
}
