<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IndexProductGet extends FormRequest
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
            'q' => 'sometimes|required|string',
            'filter' => 'sometimes|required|array',
            'sort' => 'sometimes|required|in:name,brand,unit_price,quantity,created_at,updated_at',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('filter')) {
            $filters = explode(',', $this->get('filter'));

            $standardized_filter = [];
            foreach ($filters as $filter) {
                $filter = explode(':', $filter);
                if (count($filter) == 2) $standardized_filter[$filter[0]] = $filter[1];
            }

            if (!empty($standardized_filter)) $this->merge(['filter' => $standardized_filter]);
        }
    }
}
