<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        $rules = [
            'nome'=> ['required','unique:produtos,nome,' . $this->route('product')],
            'brand' => ['required', 'string'],
            'preco' => ['required','numeric'],
            'qtd_estoque' => ['required','numeric']
        ];
        if ($this->method() != 'POST') {
            $rules = [
                'nome'=> ['string','unique:produtos,nome,' . $this->route('product')],
                'brand' => ['string'],
                'preco' => ['numeric'],
                'qtd_estoque' => ['numeric']
            ];
        }
        return $rules;
    }
}
