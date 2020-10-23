<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class EntityFactory extends Factory{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = new Faker;
        return [
            "founding_year" => $faker->year,
            "entity_type_id" => $faker->numberBetween($min = 1, $max = 6),
            "name" => $faker->company,
            "name_additional" => $faker->companySuffix,
            "primary_email" => $faker->safeEmail,
            "secondary_email" => $faker->safeEmail,
            "phone_country_code" => 20,
            "phone" => $faker->numberBetween($min = 100000000, $max = 999999999),
            "fax" => $faker->numberBetween($min = 100000000, $max = 999999999),
            "primary_address" => $faker->streetAddress,
            "primary_country_id" => $faker->numberBetween($min = 1, $max = 232),
            "primary_city_id" => $faker->numberBetween($min = 1, $max = 12958),
            "primary_postbox" => $faker->postcode,
            "primary_postal_code" => $faker->postcode,
            "secondary_address" => $faker->streetAddress,
            "secondary_country_id" => $faker->numberBetween($min = 1, $max = 232),
            "secondary_city_id" => $faker->numberBetween($min = 1, $max = 12958),
            "secondary_postbox" => $faker->postcode,
            "secondary_postal_code" => $faker->postcode,
            "legal_form" => $faker->randomElement($array = array('Public', 'Private')),
            "activity" => $faker->randomElement($array = array('Export', 'Import', 'Production', 'Services', 'Trade')),
            "business_type" => $faker->randomElement($array = $array('Start-Up', 'Scale-Up', 'Traditional Business')),
            "entity_size" => $faker->randomElement($array = array('1-25', '26-50', '51-100', '101-250', '>250')),
            "employees" => $faker->randomElement($array = array('100-300', '150-200', '101-250', '250-500', '>500')),
            "students" => $faker->randomElement($array = array('<200', '201-500', '501-1000', '1001-5000', '5001-10000', '10001-20000', '20001-50000', '50001-100000', '>100000')),
            "turn_over" => $faker->randomElement($array = array('<25K', '25K-50K', '50K-100K', '100K-500K', '500K-1Mio', '1Mio-3Mio', '3Mio-5Mio', '5Mio-10Mio', '>10Mio')),
            "balance_sheet" => $faker->randomElement($array = array('<25Mio', '25Mio-50Mio', '50Mio-100Mio', '100Mio-500Mio', '500Mio-1Bil', '1Bil-3Bil', '3Bil-5Bil', '5Bil-10Bil', '>10Bil')),
            "revenue" => $faker->randomElement($array = array('<25K', '25K-50K', '50K-100K', '100K-500K', '500K-1Mio', '1Mio-3Mio', '3Mio-5Mio', '5Mio-10Mio', '>10Mio')),
            "network" => 'wib',
            "owned_by" => factory(App\Models\User::class),
        ];
    }
}
