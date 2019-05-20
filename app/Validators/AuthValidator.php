<?php
namespace App\Validators;

use App\Traits\ValidatorTrait;
use Validator;

class AuthValidator
{
    use ValidatorTrait;

    public function validate(array &$data): bool
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $this->validator = Validator::make($data, $rules);
        return $this->isValid();
    }
}
