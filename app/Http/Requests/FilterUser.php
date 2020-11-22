<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterUser extends FormRequest
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
            'countries' => 'exclude_if:countries,null|nullable',
            'sectors' => 'exclude_if:sectors,null|nullable',
            'last_login' => 'exclude_if:last_login,null|nullable|in:asc,desc',
            'name' => 'exclude_if:name,null|nullable|in:asc,desc',
            'is_verified' => 'exclude_if:is_verified,null|nullable|in:0,1',
            'page' => 'exclude_if:page,null|nullable'
        ];
    }
}
