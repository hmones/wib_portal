<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition()
    {
        return [
            'content'    => $this->faker->sentence(),
            'active'     => 1,
            'user_id'    => User::factory(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
