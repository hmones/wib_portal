<?php

namespace App\Http\Traits;

trait HasValidationRules
{
    protected function linkRules(): array
    {
        return [
            'links.*'         => 'exclude_if:links.*.url,null|required',
            'links.*.url'     => 'exclude_if:links.*.url,null|required|active_url',
            'links.*.type_id' => 'exclude_if:links.*.url,null|required|exists:supported_links,id'
        ];
    }
}
