<?php

namespace Database\Factories;


use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'name'              => $this->faker->name,
            'email'             => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password'          => 'pjYqy8P3hD7RVuzZrsrq',
            'remember_token'    => Str::random(10),
            'created_at'        => now(),
            'updated_at'        => now()
        ];
    }
}
