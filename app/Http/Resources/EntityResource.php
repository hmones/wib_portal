<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'business_type'     => $this->business_type,
            'name'              => $this->name,
            'additional_name'   => $this->name_additional,
            'image'             => $this->image,
            'entity_type'       => optional($this->type)->name,
            'founding_year'     => $this->founding_year,
            'primary_address'   => $this->primary_address . ' ' . $this->primary_postal_code . ' ' . optional($this->primary_city)->name . ' ' . optional($this->primary_country)->name,
            'secondary_address' => $this->secondary_address . ' ' . $this->secondary_postal_code . ' ' . optional($this->secondary_city)->name . ' ' . optional($this->secondary_country)->name,
            'primary_email'     => $this->primary_email,
            'secondary_email'   => $this->secondary_email,
            'phone'             => '+' . $this->phone_country_code . $this->phone,
            'fax'               => $this->fax,
            'legal_form'        => $this->legal_form,
            'activity'          => $this->activity,
            'entity_size'       => $this->entity_size,
            'turn_over'         => $this->turn_over,
            'balance_sheet'     => $this->balance_sheet,
            'revenue'           => $this->revenue,
            'number_employees'  => $this->employees,
            'number_students'   => $this->students,
            'ecommerce_link'    => $this->ecommerce_link,
            'ecommerce_rating'  => $this->ecommerce_rating,
            'owned_by'          => optional($this->owned_by)->name,
            'created_at'        => $this->created_at
        ];
    }
}
