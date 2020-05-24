<?php

namespace App\Http\Requests\Bookmark;

use App\Rules\DeletePasswordCorrect;
use Illuminate\Foundation\Http\FormRequest;

class DeleteBookmarkRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => ['required', new DeletePasswordCorrect($this->route('bookmark'))]
        ];
    }
}
