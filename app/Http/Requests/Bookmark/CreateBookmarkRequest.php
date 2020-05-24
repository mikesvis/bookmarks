<?php

namespace App\Http\Requests\Bookmark;

use App\Helpers\Parser;
use App\Rules\PageExists;
use App\Rules\PageUnique;
use Illuminate\Foundation\Http\FormRequest;

class CreateBookmarkRequest extends FormRequest
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
     * Prepare fields for validation
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $url = Parser::normalizeUrl($this->url);

        $this->merge([
            'url' => empty($url) ? 'page-not-found' : $url
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => ['required', 'string', new PageExists, 'url', new PageUnique],
            'password' => ['nullable', 'string', 'min:5', 'confirmed'],
        ];
    }
}
