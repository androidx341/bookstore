<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookCreateRequest extends ApiRequest
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
            'title' => ['required', 'string', 'max:255'],
            'authorId' => ['required', 'integer', 'exists:authors,id'],
            'pagesCount' => ['required', 'integer', 'min:1'],
            'annotation' => ['string'],
            'coverImage'=> ['string']
        ];
    }
}
