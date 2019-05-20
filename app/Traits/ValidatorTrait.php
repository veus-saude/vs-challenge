<?php
namespace App\Traits;

use Illuminate\Support\MessageBag;

trait ValidatorTrait
{
    private $validator;
    private $errors = [];

    public function addError($category, $message)
    {
        if (!array_key_exists($category, $this->errors)) {
            $this->errors[$category] = [];
        }

        if (!in_array($message, $this->errors[$category])) {
            $this->errors[$category][] = trans($message);
        }

        return $this;
    }

    public function addErrors($arg0, $arg1 = null)
    {
        $category = null;
        $errors = null;

        if(gettype($arg0) == 'string')      $category = $arg0;
        if(gettype($arg0) == 'array')       $errors = $arg0;
        if($arg0 instanceof MessageBag)     $errors = $arg0->toArray();
        if(gettype($arg1) == 'array')       $errors = $arg1;
        if($arg1 instanceof MessageBag)     $errors = $arg1->toArray();

        if (is_array($errors) and !empty($errors)) {
            foreach ($errors as $_category => $_errors) {
                foreach ($_errors as $error) {
                    $this->addError(($category ? $category . '.' : '') . $_category, $error);
                }
            }
        }

        return $this;
    }

    public function getErrors()
    {
        if (isset($this->validator)) {
            $this->addErrors($this->validator->errors());
        }

        return $this->errors;
    }

    public function hasError()
    {
        return !empty($this->getErrors());
    }

    public function isValid(): bool
    {
        return !$this->hasError();
    }

    public function resetErrors()
    {
        $this->errors = [];
        return $this;
    }
}
