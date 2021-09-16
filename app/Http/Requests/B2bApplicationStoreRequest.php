<?php

namespace App\Http\Requests;

use App\Http\Traits\HasValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class B2bApplicationStoreRequest extends FormRequest
{
    use HasValidationRules;

    public function rules(): array
    {
        $requiredStringRule = 'required|string';

        return array_merge([
            'type'                    => 'required|in:provider,client',
            'entity_id'               => 'required|exists:entities,id',
            'data.presentation'       => $requiredStringRule,
            'data.motivation'         => $requiredStringRule,
            'data.representation'     => 'nullable|string',
            'user.phone_country_code' => 'required|digits_between:1,5',
            'user.phone'              => 'required|digits_between:4,20',
            'user.bio'                => $requiredStringRule,
        ], $this->linkRules('user.'));
    }
}
