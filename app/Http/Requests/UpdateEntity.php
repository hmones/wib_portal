<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntity extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            "entity.image" => "logo",
            "entity.entity_type_id" => "type of organization",
            "entity.founding_year" => "founding year",
            "entity.name_additional" => "additional name",
            "entity.primary_email" => "primary email",
            "entity.secondary_email" => "secondary email",
            "entity.phone_country_code" => "country calling code",
            "entity.phone" => "phone number",
            "entity.fax" => "fax number",
            "links.*.url" => "link",
            "links.*.type_id" => "link type",
            "entity.photosID[*]"=>"organization photo",
            "entity.primary_address" => "primary address",
            "entity.primary_country_id" => "primary country",
            "entity.primary_city_id" => "primary city",
            "entity.primary_postbox" => "primary post box",
            "entity.primary_postal_code" => "primary postal code",
            "entity.secondary_address" => "secondary address",
            "entity.secondary_country_id" => "secondary country",
            "entity.secondary_city_id" => "secondary city",
            "entity.secondary_postbox" => "secondary post box",
            "entity.secondary_postal_code" => "secondary postal code",
            "sectors.*.sector_id" => "field of work",
            "entity.legal_form" => "legal form",
            "entity.activity" => "organization activity",
            "entity.business_type" => "business type",
            "entity.entity_size" => "entity size",
            "entity.employees" => "number of employees",
            "entity.students" => "number of students",
            "entity.turn_over" => "annual turnover",
            "entity.balance_sheet" => "balance sheet",
            "entity.revenue" => "revenue",
            "entity.network" => "network",
            "users.relation" => "relationship to the organization",
            "photosID.*" => "photos"
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "entity.image" => "exclude_if:entity.image,null|nullable|image|max:2048",
            "entity.entity_type_id" => "required|exists:entity_types,id",
            "entity.founding_year" => "nullable|date_format:Y",
            "entity.name_additional" => "nullable|string",
            "entity.primary_email" => "required|email",
            "entity.secondary_email" => "nullable|email",
            "entity.phone_country_code" => "nullable|required_with:phone|digits_between:1,5",
            "entity.phone" => "nullable|digits_between:4,20",
            "entity.fax" => "nullable|digits_between:4,20",
            "links.*.url" => "exclude_if:links.*.url,null|nullable|active_url",
            "links.*.type_id" => "exclude_if:links.*.url,null|nullable|exists:supported_links,id",
            "entity.photosID[*]"=>"nullable|exists:photos,id",
            "entity.primary_address" => "required|string|between:0,100",
            "entity.primary_country_id" => "required|exists:countries,id",
            "entity.primary_city_id" => "required|exists:cities,id",
            "entity.primary_postbox" => "nullable|alpha_num|between:0,100",
            "entity.primary_postal_code" => "nullable|alpha_num|between:0,50",
            "entity.secondary_address" => "nullable|string|between:0,100",
            "entity.secondary_country_id" => "nullable|exists:countries,id",
            "entity.secondary_city_id" => "nullable|exists:cities,id",
            "entity.secondary_postbox" => "nullable|alpha_num|between:0,100",
            "entity.secondary_postal_code" => "nullable|alpha_num|between:0,50",
            "sectors.*.sector_id" => "exclude_if:sectors.*.sector_id,null|nullable|exists:sectors,id",
            "entity.legal_form" => "nullable|in:Public,Private",
            "entity.activity" => "nullable|in:Export,Import,Production,Services,Trade",
            "entity.business_type" => "nullable|in:Start-Up,Scale-Up,Traditional Business",
            "entity.entity_size" => "nullable|in:1-25,26-50,51-100,101-250,>250",
            "entity.employees" => "nullable|in:100-300,150-200,101-250,250-500,>500",
            "entity.students" => "nullable|in:<200,201-500,501-1000,1001-5000,5001-10000,10001-20000,20001-50000,50001-100000,>100000",
            "entity.turn_over" => "nullable|in:<25K,25K-50K,50K-100K,100K-500K,500K-1Mio,1Mio-3Mio,3Mio-5Mio,5Mio-10Mio,>10Mio",
            "entity.balance_sheet" => "nullable|in:<25Mio,25Mio-50Mio,50Mio-100Mio,100Mio-500Mio,500Mio-1Bil,1Bil-3Bil,3Bil-5Bil,5Bil-10Bil,>10Bil",
            "entity.revenue" => "nullable|in:<25K,25K-50K,50K-100K,100K-500K,500K-1Mio,1Mio-3Mio,3Mio-5Mio,5Mio-10Mio,>10Mio",
            "entity.network" => "required|in:wib",
            "entity.ecommerce_link" => "nullable|url",
            "entity.ecommerce_rating" => "nullable|numeric|between:0.00,5.00",
            "users.relation" => "required",
            "photosID.*" => "exclude_if:photosID.*,null|nullable|exists:photos,id"
        ];
    }
}
