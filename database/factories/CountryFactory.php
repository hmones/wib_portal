<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    protected $model = Country::class;

    public function definition()
    {
        return [
            "country_iso_code" => 4,
            "name" => "Afghanistan",
            "code" => "af",
            "code_long" => "AFG",
            "calling_code" => 93,
            "continent" => "AS",
            "mena" => 0
        ];
    }
}
