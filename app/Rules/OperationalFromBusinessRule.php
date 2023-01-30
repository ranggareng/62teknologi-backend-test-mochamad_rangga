<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

// Model
use App\Models\BusinessOperational;

class OperationalFromBusinessRule implements Rule
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
        if($value == 0)
            return true;

        $operational = BusinessOperational::find($value);

        if(!$operational)
            return false;
            
        if($operational->business->id == $this->params || $operational->business->alias == $this->params)
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
        return ':attribute is not part of the business';
    }
}
