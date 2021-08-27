<?php

namespace Database\Factories;

use App\Models\{Country, Post, Sector, User};
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'content'    => $this->faker->paragraph(3),
            'image'      => $this->faker->randomElement(array('https://source.unsplash.com/random', '', '', '')),
            'post_type'  => $this->faker->randomElement(array('Help', 'Recommendations', 'Advice', 'Products',
                                                              'Services', 'Buyer', 'Seller', 'Attending a fair',
                                                              'Organizing a fair', 'Participating in an event',
                                                              'Announcing news', 'Launching new product')),
            'user_id'    => User::factory(),
            'sector_id'  => Sector::factory(),
            'country_id' => Country::factory(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
