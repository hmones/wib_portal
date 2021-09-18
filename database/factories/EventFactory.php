<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'title'       => $this->faker->sentence,
            'description' => $this->faker->text,
            'from'        => now()->subDays(2),
            'to'          => now(),
            'location'    => $this->faker->city,
            'image'       => $this->faker->imageUrl(),
            'link'        => $this->faker->url,
            'button_text' => 'Read more',
            'is_main'     => false,
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
}
