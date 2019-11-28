<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

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
            'name'     => 'required|string|min:3',
            'brand_id' => 'required|integer|exists:brands,id'
        ];
    }
    
    public function messages()
    {
        return [
            'name.required'     => 'Informe o nome do produto (campo `name`)',
            'name.string'       => 'Nome do produto deve ser uma string válida',
            'name.min'          => 'Nome do produto deve conter pelo menos 3 caractéres',
            'brand_id.required' => 'Informe a marca do produto (campo `brand_id`)',
            'brand_id.integer'  => 'Marca do produto deve ser um número inteiro (campo `brand_id`)',
            'brand_id.exists'   => 'A marca informada para este produto não foi encontrada'
        ];
    }
}
