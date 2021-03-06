<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use App\Models\Entity;
use App\Models\EntityType;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityFactory extends Factory
{
    protected $model = Entity::class;

    public function definition()
    {
        return [
            "founding_year" => $this->faker->year,
            "entity_type_id" => optional(EntityType::where('name', 'Business')->first())->id,
            "name" => $this->faker->company,
            "name_additional" => $this->faker->companySuffix,
            "primary_email" => $this->faker->safeEmail,
            "secondary_email" => $this->faker->safeEmail,
            "phone_country_code" => 20,
            "phone" => $this->faker->numberBetween($min = 100000000, $max = 999999999),
            "fax" => $this->faker->numberBetween($min = 100000000, $max = 999999999),
            "primary_address" => $this->faker->streetAddress,
            "primary_country_id" => optional(Country::where('name', 'Egypt')->first())->id,
            "primary_city_id" => optional(City::where('name', 'Cairo')->first())->id,
            "primary_postbox" => $this->faker->postcode,
            "primary_postal_code" => $this->faker->postcode,
            "secondary_address" => $this->faker->streetAddress,
            "secondary_country_id" => null,
            "secondary_city_id" => null,
            "secondary_postbox" => $this->faker->postcode,
            "secondary_postal_code" => $this->faker->postcode,
            "legal_form" => $this->faker->randomElement($array = array('Public', 'Private')),
            "activity" => $this->faker->randomElement($array = array('Export', 'Import', 'Production', 'Services', 'Trade')),
            "business_type" => $this->faker->randomElement($array = array('Start-Up', 'Scale-Up', 'Traditional Business')),
            "entity_size" => $this->faker->randomElement($array = array('1-25', '26-50', '51-100', '101-250', '>250')),
            "employees" => $this->faker->randomElement($array = array('100-300', '150-200', '101-250', '250-500', '>500')),
            "students" => $this->faker->randomElement($array = array('<200', '201-500', '501-1000', '1001-5000', '5001-10000', '10001-20000', '20001-50000', '50001-100000', '>100000')),
            "turn_over" => $this->faker->randomElement($array = array('<25K', '25K-50K', '50K-100K', '100K-500K', '500K-1Mio', '1Mio-3Mio', '3Mio-5Mio', '5Mio-10Mio', '>10Mio')),
            "balance_sheet" => $this->faker->randomElement($array = array('<25Mio', '25Mio-50Mio', '50Mio-100Mio', '100Mio-500Mio', '500Mio-1Bil', '1Bil-3Bil', '3Bil-5Bil', '5Bil-10Bil', '>10Bil')),
            "revenue" => $this->faker->randomElement($array = array('<25K', '25K-50K', '50K-100K', '100K-500K', '500K-1Mio', '1Mio-3Mio', '3Mio-5Mio', '5Mio-10Mio', '>10Mio')),
            "network" => 'wib',
            "owned_by" => null,
        ];
    }
}
