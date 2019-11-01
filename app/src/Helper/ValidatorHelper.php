<?php

namespace App\Helper;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidatorHelper
{
    /**
     * Undocumented variable
     *
     * @var ValidatorInterface
     */
    protected $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function errorFormater($errors): array
    {
        $errorsResponse = [];
        foreach ($errors as $item) {
            $errorsResponse[$item->getPropertyPath()] = $item->getMessage();
        }
        return $errorsResponse;
    }

    public function validate($entity): array
    {
        $errorsResponse = array();
        $errors = $this->validator->validate($entity);
        if (count($errors) > 0) {
            $errorsResponse = $this->errorFormater($errors);
        }
        return $errorsResponse;
    }
}
