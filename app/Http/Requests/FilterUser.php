<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterUser extends FormRequest
{
    public function rules(): array
    {
        return [
            'countries'   => 'exclude_if:countries,null|nullable',
            'sectors'     => 'exclude_if:sectors,null|nullable',
            'last_login'  => 'exclude_if:last_login,null|nullable|in:asc,desc',
            'name'        => 'exclude_if:name,null|nullable|in:asc,desc',
            'is_verified' => 'exclude_if:is_verified,null|nullable|in:0,1',
            'page'        => 'exclude_if:page,null|nullable'
        ];
    }
}
