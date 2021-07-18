<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUser extends FormRequest
{
    public function attributes(): array
    {
        return [
            'user.image'                    => 'Profile image',
            'user.title'                    => 'Title',
            'user.name'                     => 'Full name',
            'user.email'                    => 'Email address',
            'user.password'                 => 'Password',
            'user.bio'                      => 'About section',
            'user.education'                => 'Education',
            'user.gender'                   => 'Gender',
            'user.birth_year'               => 'Birth year',
            'links.*.url'                   => 'Profile link',
            'user.phone_country_code'       => 'Phone country code',
            'user.phone'                    => 'Phone',
            'user.country_id'               => 'Country',
            'user.city_id'                  => 'City',
            'user.postal_code'              => 'Postal code',
            'sectors.*.sector_id'           => 'Sector',
            'user.business_association_wom' => 'Business women association',
            'user.gdpr_consent'             => 'GDPR consent',
        ];
    }

    public function rules(): array
    {
        return [
            'user.image'                    => 'nullable|image|max:2048',
            'user.title'                    => 'required|in:Mr.,Ms.,Prof.,Dr.',
            'user.name'                     => 'required|string',
            'user.email'                    => 'required|confirmed|email|unique:App\Models\User,email',
            'user.password'                 => 'required|confirmed|string',
            'user.bio'                      => 'nullable|string',
            'user.education'                => 'required|in:Highschool,Bachelor,Master,Doctorate',
            'user.gender'                   => 'required|in:Male,Female',
            'user.birth_year'               => 'nullable|date_format:Y',
            'links.*.url'                   => 'exclude_if:links.*.url,null|required|active_url',
            'links.*.type_id'               => 'exclude_if:links.*.url,null|required|exists:supported_links,id',
            'user.phone_country_code'       => 'required|digits_between:1,5',
            'user.phone'                    => 'required|digits_between:4,20',
            'user.country_id'               => 'required|exists:countries,id',
            'user.city_id'                  => 'required|exists:cities,id',
            'user.postal_code'              => 'nullable|alpha_num|between:0,50',
            'sectors.*.sector_id'           => 'exclude_if:sectors.*.sector_id,null|nullable|exists:sectors,id',
            'user.business_association_wom' => 'nullable|in:ABWA,BWE21,CNFCE,LLWB,SEVE,EBRD,Other',
            'user.gdpr_consent'             => 'required|boolean',
            'user.newsletter'               => 'nullable|boolean',
            'user.mena_diaspora'            => 'nullable|boolean',
        ];
    }
}
