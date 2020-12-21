<?php

namespace App\Http\Requests;

use App\Models\Produto;
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
    public function rules(Produto $produto)
    {
        if ($this->method() != 'POST') {
            return [
                'nome' =>  'string',
                'marca' => 'string',
                'preco' => 'numeric',
                'quantidade' => 'numeric',
            ];
        } else {
            return [
                'nome' =>  ['required', 'string'],
                'marca' => ['required', 'string'],
                'preco' => ['required', 'numeric'],
                'quantidade' => ['required', 'numeric'],
            ];
        }
    }

    public function messages()
    {
        return [
            'nome.required' => 'Nome Obrigatório',
            'marca.required' => 'Marca Obrigatório',
            'preco.required' => 'Preço Obrigatório',
            'quantidade.required' => 'Quantidade Obrigatório',

        ];
    }
}
