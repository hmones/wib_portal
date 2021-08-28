<?php

namespace App\Http\Requests;

use App\Http\Traits\HasValidationRules;
use Illuminate\Foundation\Http\FormRequest;

class StoreEntity extends FormRequest
{
    use HasValidationRules;

    public function attributes(): array
    {
        return $this->entityAttributes();
    }

    public function rules(): array
    {
        return array_merge(
            $this->linkRules(),
            $this->entityBasicRules(),
            [
                "entity.name" => "required|string|unique:App\Models\Entity,name",
            ]
        );
    }
}
