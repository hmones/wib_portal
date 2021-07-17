<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    protected $model = Message::class;

    public function definition(): array
    {
        return [
            'id'         => mt_rand(9, 999999999) + time(),
            'type'       => 'user',
            'from_id'    => User::factory(),
            'to_id'      => User::factory(),
            'body'       => $this->faker->sentence,
            'seen'       => $this->faker->boolean(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
