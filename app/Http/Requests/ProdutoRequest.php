<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
            'name'=>'required',
            'brand'=>'required',
            'price'=>'required',
            'quantity'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Coloque o nome!',
            'brand.required'=>'Coloque a marca!',
            'price.required'=>'Coloque o preço!',
            'quantity.required'=>'Coloque a quantidade!'
        ];
    }
}
