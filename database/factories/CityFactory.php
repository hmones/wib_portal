<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    protected $model = City::class;

    public function definition()
    {
        return [
            "geoname_id" => 1004003059,
            "name" => "Kandahar",
            "state" => "Kandahār",
            "country_id" => 4
        ];
    }
}
