<?php
namespace App\Http\Requests\V2;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'name'          => 'sometimes|min:3',
            'price'         => 'sometimes|numeric',
            'quantity'      => 'sometimes|integer',
            'brand_id'      => 'sometimes|exists:mysql.vs.brand,brand_id',
            '_method'       => 'required|in:PUT,PATCH'

        ];
    }
}
