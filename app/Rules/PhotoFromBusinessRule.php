<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

// Model
use App\Models\BusinessPhoto;

class PhotoFromBusinessRule implements Rule
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
        $photo = BusinessPhoto::find($value);

        if($photo->business->id == $this->params || $photo->business->alias == $this->params)
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
