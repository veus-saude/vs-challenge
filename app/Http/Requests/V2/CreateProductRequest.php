<?php
namespace App\Http\Requests\V2;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name'          => 'required|min:3',
            'price'         => 'required|numeric',
            'quantity'      => 'required|integer',
            'brand_id'      => 'required|exists:mysql.vs.brand,brand_id',

        ];
    }
}
