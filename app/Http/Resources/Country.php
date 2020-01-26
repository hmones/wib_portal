<?php

namespace App\Http\Resources;

use App\Http\Resources\City as CityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Country extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'code'=>$this->code,
            'calling_code'=>$this->calling_code,
            'cities' => CityResource::collection($this->cities),
        ];
    }
}
