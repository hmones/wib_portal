<?php

namespace Database\Factories;

use App\Models\Link;
use App\Models\SupportedLink;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    protected $model = Link::class;

    public function definition(): array
    {
        return [
            'url'        => $this->faker->url,
            'type_id'    => SupportedLink::factory(),
            'created_at' => now(),
            'updated_at' => now()
        ];
    }
}
