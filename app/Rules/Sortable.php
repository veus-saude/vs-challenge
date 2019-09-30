<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Sortable implements Rule
{
    private $availableColumns;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($availableColumns = [])
    {
        $this->availableColumns = $availableColumns;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $value = explode(':', $value);

        if (isset($value[1]) && ! in_array($value[1], ['asc', 'desc'])) {
            return false;
        }

        if (! in_array($value[0], $this->availableColumns)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Sort field is invalid.';
    }
}
