<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxArrayLength implements Rule
{
    protected $maxLength;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($maxLength)
    {
        $this->maxLength = $maxLength;
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
        return is_array($value) && count($value) <= $this->maxLength;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "La commande ne peut pas dépasser plus de {$this->maxLength} menus.";
    }
}
