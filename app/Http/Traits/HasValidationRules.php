<?php

namespace App\Http\Traits;

trait HasValidationRules
{
    protected string $postalCodeRules = 'nullable|alpha_num|between:0,50';
    protected string $linksUrlKey = 'links.*.url';
    protected string $sectorsIdKey = 'sectors.*.sector_id';

    protected function linkRules($prefix = null): array
    {
        $excludeRule = 'exclude_if:' . $prefix . 'links.*.url,null';

        return [
            $prefix . 'links.*'          => $excludeRule . '|required',
            $prefix . $this->linksUrlKey => $excludeRule . '|required|active_url',
            $prefix . 'links.*.type_id'  => $excludeRule . '|required|exists:supported_links,id'
        ];
    }

    protected function userAttributes(): array
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
            $this->linksUrlKey              => 'Profile link',
            'user.phone_country_code'       => 'Phone country code',
            'user.phone'                    => 'Phone',
            'user.country_id'               => 'Country',
            'user.city_id'                  => 'City',
            'user.postal_code'              => 'Postal code',
            $this->sectorsIdKey             => 'Sector',
            'user.business_association_wom' => 'Business women association',
            'user.gdpr_consent'             => 'GDPR consent',
        ];
    }

    protected function userBasicRules(): array
    {
        return [
            'user.image'                    => 'nullable|image|max:2048',
            'user.title'                    => 'required|in:Mr.,Ms.,Prof.,Dr.',
            'user.name'                     => 'required|string',
            'user.bio'                      => 'nullable|string',
            'user.education'                => 'required|in:Highschool,Bachelor,Master,Doctorate',
            'user.gender'                   => 'required|in:Male,Female',
            'user.birth_year'               => 'nullable|date_format:Y',
            'user.phone_country_code'       => 'required|digits_between:1,5',
            'user.phone'                    => 'required|digits_between:4,20',
            'user.country_id'               => 'required|exists:countries,id',
            'user.city_id'                  => 'required|exists:cities,id',
            'user.postal_code'              => $this->postalCodeRules,
            'user.business_association_wom' => 'nullable|in:ABWA,BWE21,CNFCE,LLWB,SEVE,EBRD,Other',
            'user.newsletter'               => 'nullable|boolean',
            'user.mena_diaspora'            => 'nullable|boolean',
        ];
    }

    protected function eventBasicRules(): array
    {
        return [
            'title'       => 'required',
            'description' => 'nullable',
            'link'        => 'required_with:button_text|nullable',
            'button_text' => 'required_with:link|nullable',
            'location'    => 'nullable',
            'from'        => 'required|date|before:to',
            'to'          => 'required|date|after:from',
            'is_main'     => 'sometimes|boolean'
        ];
    }

    protected function entityBasicRules(): array
    {
        return [
            'entity.image'                 => 'exclude_if:entity.image,null|nullable|image|max:2048',
            'entity.entity_type_id'        => 'required|exists:entity_types,id',
            'entity.founding_year'         => 'nullable|date_format:Y',
            'entity.name_additional'       => 'nullable|string',
            'entity.primary_email'         => 'required|email',
            'entity.secondary_email'       => 'nullable|email',
            'entity.phone_country_code'    => 'nullable|required_with:phone|digits_between:1,5',
            'entity.phone'                 => 'nullable|digits_between:4,20',
            'entity.fax'                   => 'nullable|digits_between:4,20',
            'entity.photosID[*]'           => 'nullable|exists:photos,id',
            'entity.primary_address'       => 'required|string|between:0,100',
            'entity.primary_country_id'    => 'required|exists:countries,id',
            'entity.primary_city_id'       => 'required|exists:cities,id',
            'entity.primary_postbox'       => 'nullable|alpha_num|between:0,100',
            'entity.primary_postal_code'   => $this->postalCodeRules,
            'entity.secondary_address'     => 'nullable|string|between:0,100',
            'entity.secondary_country_id'  => 'nullable|exists:countries,id',
            'entity.secondary_city_id'     => 'nullable|exists:cities,id',
            'entity.secondary_postbox'     => 'nullable|alpha_num|between:0,100',
            'entity.secondary_postal_code' => $this->postalCodeRules,
            $this->sectorsIdKey            => 'exclude_if:sectors.*.sector_id,null|nullable|exists:sectors,id',
            'entity.legal_form'            => 'nullable|in:Public,Private',
            'entity.activity'              => 'nullable|in:Export,Import,Production,Services,Trade',
            'entity.business_type'         => 'nullable|in:Start-Up,Scale-Up,Traditional Business',
            'entity.entity_size'           => 'nullable|in:1-25,26-50,51-100,101-250,>250',
            'entity.employees'             => 'nullable|in:100-300,150-200,101-250,250-500,>500',
            'entity.students'              => 'nullable|in:<200,201-500,501-1000,1001-5000,5001-10000,10001-20000,20001-50000,50001-100000,>100000',
            'entity.turn_over'             => 'nullable|in:<25K,25K-50K,50K-100K,100K-500K,500K-1Mio,1Mio-3Mio,3Mio-5Mio,5Mio-10Mio,>10Mio',
            'entity.balance_sheet'         => 'nullable|in:<25Mio,25Mio-50Mio,50Mio-100Mio,100Mio-500Mio,500Mio-1Bil,1Bil-3Bil,3Bil-5Bil,5Bil-10Bil,>10Bil',
            'entity.revenue'               => 'nullable|in:<25K,25K-50K,50K-100K,100K-500K,500K-1Mio,1Mio-3Mio,3Mio-5Mio,5Mio-10Mio,>10Mio',
            'entity.network'               => 'required|in:wib',
            'entity.ecommerce_link'        => 'nullable|url',
            'entity.ecommerce_rating'      => 'nullable|numeric|between:0.00,5.00',
            'users.relation'               => 'required',
            'photosID.*'                   => 'exclude_if:photosID.*,null|nullable|exists:photos,id'
        ];
    }

    protected function entityAttributes(): array
    {
        return [
            'entity.image'                 => 'logo',
            'entity.entity_type_id'        => 'type of organization',
            'entity.founding_year'         => 'founding year',
            'entity.name'                  => 'organization name',
            'entity.name_additional'       => 'additional name',
            'entity.primary_email'         => 'primary email',
            'entity.secondary_email'       => 'secondary email',
            'entity.phone_country_code'    => 'country calling code',
            'entity.phone'                 => 'phone number',
            'entity.fax'                   => 'fax number',
            $this->linksUrlKey             => 'link',
            'links.*.type_id'              => 'link type',
            'entity.photosID[*]'           => 'organization photo',
            'entity.primary_address'       => 'primary address',
            'entity.primary_country_id'    => 'primary country',
            'entity.primary_city_id'       => 'primary city',
            'entity.primary_postbox'       => 'primary post box',
            'entity.primary_postal_code'   => 'primary postal code',
            'entity.secondary_address'     => 'secondary address',
            'entity.secondary_country_id'  => 'secondary country',
            'entity.secondary_city_id'     => 'secondary city',
            'entity.secondary_postbox'     => 'secondary post box',
            'entity.secondary_postal_code' => 'secondary postal code',
            $this->sectorsIdKey            => 'field of work',
            'entity.legal_form'            => 'legal form',
            'entity.activity'              => 'organization activity',
            'entity.business_type'         => 'business type',
            'entity.entity_size'           => 'entity size',
            'entity.employees'             => 'number of employees',
            'entity.students'              => 'number of students',
            'entity.turn_over'             => 'annual turnover',
            'entity.balance_sheet'         => 'balance sheet',
            'entity.revenue'               => 'revenue',
            'entity.network'               => 'network',
            'users.relation'               => 'relationship to the organization',
            'photosID.*'                   => 'photos'
        ];
    }
}
