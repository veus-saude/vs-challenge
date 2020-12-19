<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CadastroValidator extends FormRequest
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
          'name' => 'required|max:80|regex:/[^*]/',
          'email' => 'required|regex:/[0-9a-z]*@[0-9a-z]*.[a-z]/|unique:users,email',
        ];
    }

    public function messages() {
        return [
            //fields required
            'required' => 'O campo ":attribute" é obrigatório.',
            'unique' => 'Já existe um registro com esse ":attribute".',
        ];
    }
}
