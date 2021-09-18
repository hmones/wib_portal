<?php

namespace App\Http\Requests;

use App\Models\Round;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoundStore extends FormRequest
{
    public function rules(): array
    {
        return [
            'text_providers'   => 'nullable',
            'text_application' => 'nullable',
            'from'             => 'required|date|before:to',
            'to'               => 'required|date|after:from',
            'max_applicants'   => 'required|numeric',
            'status'           => ['required', Rule::in(Round::STATUSES)]
        ];
    }
}
