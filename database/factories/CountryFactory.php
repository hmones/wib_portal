<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
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
