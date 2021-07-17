<?php

namespace Database\Factories;

use App\Models\SupportedLink;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupportedLinkFactory extends Factory
{
    protected $model = SupportedLink::class;

    public function definition(): array
    {
        return [
            'name'       => $this->faker->name,
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
