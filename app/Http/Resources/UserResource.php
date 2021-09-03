<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id'                   => $this->id,
            'title'                => $this->title,
            'name'                 => $this->name,
            'email'                => $this->email,
            'image'                => $this->image,
            'gender'               => $this->gender,
            'birth_year'           => $this->birth_year,
            'bio'                  => $this->bio,
            'phone'                => '+' . $this->phone_country_code . $this->phone,
            'country'              => optional($this->country)->name,
            'city'                 => optional($this->city)->name,
            'postal_code'          => $this->postal_code,
            'education'            => $this->education,
            'mena_diaspora'        => $this->mena_diaspora ? 'yes' : 'no',
            'business_association' => $this->business_association_wom,
            'profile_completion'   => $this->data_percent . '%',
            'last_login'           => $this->last_login,
            'created_at'           => $this->created_at
        ];
    }
}
