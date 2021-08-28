<?php

namespace App\Http\Requests;

use App\Http\Traits\HasValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    use HasValidationRules;

    public function attributes(): array
    {
        return $this->userAttributes();
    }

    public function rules(): array
    {
        return array_merge(
            $this->linkRules(),
            $this->userBasicRules(),
            [
                'sectors.*.sector_id' => 'exclude_if:sectors.*.sector_id,null|nullable|exists:sectors,id',
                'user.email'          => 'required|confirmed|email|unique:App\Models\User,email',
                'user.password'       => 'required|confirmed|string',
                'user.gdpr_consent'   => 'required|boolean',
            ]
        );
    }
}
