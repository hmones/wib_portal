<?php

namespace Database\Factories;


use App\Models\City;
use App\Models\Country;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name'                     => $this->faker->name,
            'email'                    => $this->faker->unique()->safeEmail,
            'email_verified_at'        => now(),
            'password'                 => Hash::make('pjYqy8P3hD7RVuzZrsrq'), // password
            'remember_token'           => Str::random(10),
            'birth_year'               => $this->faker->year,
            'title'                    => $this->faker->titleFemale,
            'gender'                   => $this->faker->randomElement($array = array('Male', 'Female')),
            'phone_country_code'       => 20,
            'phone'                    => $this->faker->numberBetween(100000000, 999999999),
            'country_id'               => Country::factory(),
            'city_id'                  => City::factory(),
            'postal_code'              => $this->faker->postcode,
            'business_association_wom' => $this->faker->randomElement($array = array('ABWA', 'BWE21', 'CNFCE', 'LLWB', 'SEVE', 'Other')),
            'gdpr_consent'             => true,
            'newsletter'               => $this->faker->boolean($chanceOfGettingTrue = 50),
            'mena_diaspora'            => $this->faker->boolean($chanceOfGettingTrue = 50),
            'education'                => $this->faker->randomElement($array = array('Highschool', 'Bachelor', 'Master',
                                                                                     'Doctorate')),
            'network'                  => 'wib',
            'bio'                      => $this->faker->paragraph
        ];
    }
}
