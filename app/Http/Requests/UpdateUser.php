<?php

namespace App\Http\Requests;

use App\Http\Traits\HasValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
                'sectors.*.sector_id' => 'exclude_if:sectors.*.sector_id,null|required|exists:sectors,id',
                'user.notify_user'    => 'nullable|boolean',
                'user.notify_comment' => 'nullable|boolean',
                'user.notify_post'    => 'nullable|boolean',
                'user.notify_message' => 'nullable|boolean',
            ]
        );
    }
}
