<?php

namespace App\Http\Requests;

use App\Http\Requests\Api\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|max:50',
            'brand' => 'required|max:50',
            'price' => 'required|numeric',
            'amount' => 'required|integer'
        ];
    }
}
