<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => 'pjYqy8P3hD7RVuzZrsrq', // password
        'remember_token' => Str::random(10),
        "birth_year" => $faker->year,
        "title" => $faker->titleFemale,
        "gender" => $faker->randomElement($array = array('Male', 'Female')),
        "phone_country_code" => 20,
        "phone" => $faker->numberBetween($min = 100000000, $max = 999999999),
        "country_id" => $faker->numberBetween($min = 1, $max = 232),
        "city_id" => $faker->numberBetween($min = 1, $max = 12958),
        "postal_code" => $faker->postcode,
        "business_association_wom" => $faker->randomElement($array = array('ABWA', 'BWE21', 'CNFCE', 'LLWB', 'SEVE', 'Other')),
        "gdpr_consent" => true,
        "newsletter" => $faker->boolean($chanceOfGettingTrue = 50),
        "mena_diaspora" => $faker->boolean($chanceOfGettingTrue = 50),
        "education" => $faker->randomElement($array = array('Highschool', 'Bachelor', 'Master', 'Doctorate')),
        "network" => 'wib',
        'bio' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
    ];
});
