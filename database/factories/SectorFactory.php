<?php

namespace Database\Factories;

use App\Models\Sector;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectorFactory extends Factory
{
    protected $model = Sector::class;

    public function definition(): array
    {
        return [
            'name'       => $this->faker->name,
            'icon'       => 'search',
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
