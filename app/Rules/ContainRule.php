<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ContainRule implements Rule
{
    private $params;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = $params;
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
        $comparationFieldValue = \Request::input($this->params);

        // \Log::debug("State Value ".$comparationFieldValue);
        // \Log::debug("Value ".$value);

        if(count(explode($comparationFieldValue, $value)) > 1)
            return true;
        else
            return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute is not part of the '.$this->params;
    }
}
