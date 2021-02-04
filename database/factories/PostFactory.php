<?php

namespace Database\Factories;

use App\Models\{Country, Post, Sector, User};
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users = User::latest()->take(100)->pluck('id')->toArray();
        $countries = Country::take(10)->pluck('id')->toArray();
        $sectors = Sector::pluck('id')->toArray();
        return [
            'content' => $this->faker->paragraph(3),
            'image' => $this->faker->randomElement(array('https://source.unsplash.com/random', '', '', '')),
            'post_type' => $this->faker->randomElement(array('Help', 'Recommendations', 'Advice', 'Products', 'Services', 'Buyer', 'Seller', 'Attending a fair', 'Organizing a fair', 'Participating in an event', 'Announcing news', 'Launching new product')),
            'user_id' => $this->faker->randomElement($users),
            'sector_id' => $this->faker->randomElement($sectors),
            'country_id' => $this->faker->randomElement([$countries, '', '', '', '', '', '', '', '', '', '']),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
