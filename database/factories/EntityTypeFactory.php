<?php

namespace Database\Factories;

use App\Models\EntityType;
use Illuminate\Database\Eloquent\Factories\Factory;


class EntityTypeFactory extends Factory
{
    protected $model = EntityType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'icon' => 'user',
            'entity_size' => 0,
            'turn_over' => 0,
            'balance_sheet' => 0,
            'revenue' => 0,
            'employees' => 0,
            'students' => 0,
            'business_type' => 0
        ];
    }
}
