<?php

namespace Database\Factories;

use App\Models\Round;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoundFactory extends Factory
{
    protected $model = Round::class;

    public function definition(): array
    {
        return [
            'description'    => $this->faker->sentence,
            'from'           => now(),
            'to'             => now()->addWeek(),
            'max_applicants' => $this->faker->randomDigit,
            'status'         => $this->faker->randomElement(Round::STATUSES)
        ];
    }

    public function draft(): Factory
    {
        return $this->state(function () {
            return [
                'status' => Round::DRAFT,
            ];
        });
    }

    public function published(): Factory
    {
        return $this->state(function () {
            return [
                'status' => Round::PUBLISHED,
            ];
        });
    }

    public function open(): Factory
    {
        return $this->state(function () {
            return [
                'status' => Round::OPEN,
            ];
        });
    }

    public function closed(): Factory
    {
        return $this->state(function () {
            return [
                'status' => Round::CLOSED,
            ];
        });
    }
}
