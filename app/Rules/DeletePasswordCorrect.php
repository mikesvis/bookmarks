<?php

namespace App\Rules;

use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Rule;

class DeletePasswordCorrect implements Rule
{
    /**
     * Закладка для проверки
     *
     * @var App\Models\Bookmark
     */
    public $bookmark;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($bookmark)
    {
        $this->bookmark = $bookmark;
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
        return Hash::check($value, $this->bookmark->password);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.password');
    }
}
