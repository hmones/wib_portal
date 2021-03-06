<?php

namespace Database\Factories;

use App\Models\{Reaction, User};
use Illuminate\Database\Eloquent\Factories\Factory;

class ReactionFactory extends Factory
{
    protected $model = Reaction::class;

    public function definition()
    {
        $users = User::latest()->take(100)->pluck('id')->toArray();
        return [
            'type' => 0,
            'user_id' => $this->faker->randomElement($users),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
