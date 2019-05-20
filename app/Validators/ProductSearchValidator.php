<?php
namespace App\Validators;

use App\Traits\ValidatorTrait;
use Illuminate\Validation\Rule;
use Validator;

class ProductSearchValidator
{
    use ValidatorTrait;

    public function validate(array &$data): bool
    {
        $rules = [
            'q' => 'present|max:50',
            'filter' => 'present',
            'orderBy' => ['present', Rule::in(['product', 'brand', 'value'])],
            'sortedBy' => ['present', Rule::in(['asc', 'desc'])]
        ];

        $this->validator = Validator::make($data, $rules);
        return $this->isValid();
    }
}
