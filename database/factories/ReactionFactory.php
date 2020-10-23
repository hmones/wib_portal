<?php

namespace Database\Factories;

use App\Models\Reaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = \App\Models\User::latest()->take(100)->pluck('id')->toArray();
        return [
            'type' => 0,
            'user_id' => $this->faker->randomElement($users),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
