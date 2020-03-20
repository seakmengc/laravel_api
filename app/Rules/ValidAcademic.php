<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidAcademic implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($attribute == 'academic_y1') {
            if($value + 1 != request()->get('academic_y2'))
                return false;
        } else {
            if($value - 1 != request()->get('academic_y1'))
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
        return 'First year should be one year smaller than the second year.';
    }
}
