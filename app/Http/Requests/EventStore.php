<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventStore extends FormRequest
{
    public function rules(): array
    {
        return [
            'image'       => 'required|max:2048',
            'title'       => 'required',
            'description' => 'nullable',
            'link'        => 'required_with:button_text|nullable',
            'button_text' => 'required_with:link|nullable',
            'location'    => 'nullable',
            'from'        => 'required|date',
            'to'          => 'required|date'
        ];
    }
}
