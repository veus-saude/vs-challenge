<?php

namespace App\Http\Requests\Api\v1;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'name' => 'required|string'
        ];
    }
    
    public function messages()
    {
        return [
            'name.requred' => 'Nome da marca é obrigatório (campo `name`)',
            'name.string'  => 'Nome da marca deve ser uma string válida (campo `name`)'
        ];
    }
}
