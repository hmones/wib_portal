<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        $users = \App\Models\User::latest()->take(100)->pluck('id')->toArray();
        return [
            'content' => $this->faker->sentence(),
            'user_id' => $this->faker->randomElement($users),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
