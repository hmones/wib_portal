<?php

namespace Database\Factories;

use App\Models\B2bApplication;
use App\Models\Entity;
use App\Models\Round;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class B2bApplicationFactory extends Factory
{
    protected $model = B2bApplication::class;

    public function definition(): array
    {
        return [
            'round_id'  => Round::factory(),
            'user_id'   => User::factory(),
            'type'      => 'provider',
            'entity_id' => Entity::factory(),
            'data'      => [
                'representative' => $this->faker->name,
                'motivation'     => $this->faker->paragraph,
                'presentation'   => $this->faker->paragraph
            ],
            'status'    => B2bApplication::SUBMITTED
        ];
    }
}
