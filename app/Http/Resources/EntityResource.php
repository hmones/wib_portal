<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EntityResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'owner_id'          => optional($this->owned_by()->first())->id,
            'owner_name'        => optional($this->owned_by()->first())->name,
            'owner_association' => optional($this->owned_by()->first())->business_association_wom,
            'business_type'     => $this->business_type,
            'field_of_activity' => optional($this->sectors()->first())->name,
            'name'              => $this->name,
            'additional_name'   => $this->name_additional,
            'image'             => $this->image,
            'entity_type'       => optional($this->type)->name,
            'founding_year'     => $this->founding_year,
            'primary_address'   => $this->primary_address . ' ' . $this->primary_postal_code . ' ' . optional($this->primary_city)->name,
            'primary_country'   => optional($this->primary_country)->name,
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
