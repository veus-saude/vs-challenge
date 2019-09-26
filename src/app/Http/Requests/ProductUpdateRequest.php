<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
     * Applied 'sometimes' rule because its a update request.
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'sometimes|string|min:3',
            'brand_id'  => 'sometimes|exists:brand,id',
            'price'     => 'sometimes|nullable|regex:/^\d+(\.\d{1,2})?$/',
            'quantity'  => 'sometimes|nullable|numeric'
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
            'price.regex' => 'Price format is incorrect'
        ];
    }
}
