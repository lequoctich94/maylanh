<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CustomValidationUsername implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $username;

    public function __construct($username)
    {
        $this->$username = $username;
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
        return $this->username % 2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute chỉ được chia hết cho 2';
    }
}
