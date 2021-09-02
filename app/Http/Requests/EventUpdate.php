<?php

namespace App\Http\Requests;

use App\Http\Traits\HasValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class EventUpdate extends FormRequest
{
    use HasValidationRules;

    public function rules(): array
    {
        return array_merge($this->eventBasicRules(), [
            'image' => 'sometimes|image|max:2048',
        ]);
    }
}
