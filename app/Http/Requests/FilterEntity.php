<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterEntity extends FormRequest
{
    public function rules(): array
    {
        return [
            'countries'   => 'exclude_if:countries,null|nullable',
            'sectors'     => 'exclude_if:sectors,null|nullable',
            'name'        => 'exclude_if:name,null|nullable|in:asc,desc',
            'is_verified' => 'exclude_if:is_verified,null|nullable|in:0,1',
            'type'        => 'exclude_if:type,null|nullable|in:business,organization',
            'page'        => 'exclude_if:page,null|nullable'
        ];
    }
}
