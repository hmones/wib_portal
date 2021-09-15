<?php

namespace Tests\Feature;

use App\Models\B2bApplication;
use App\Models\Entity;
use App\Models\Link;
use App\Models\Round;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    use DatabaseTransactions;

    protected $round, $user;

    public function test_guests_cannot_access_application(): void
    {
        $this->get(route('rounds.service-providers.create', $this->round))
            ->assertRedirect(route('login'));
    }

    public function test_application_is_displayed_with_user_data(): void
    {
        $this->round->update(['status' => Round::OPEN]);

        $this->actingAs($this->user)
            ->get(route('rounds.service-providers.create', $this->round))
            ->assertSee(array_merge([
                $this->user->phone,
                $this->user->bio
            ], $this->user->links->pluck('url')->toArray()));
    }

    public function test_application_cannot_be_submitted_without_the_required_data(): void
    {
        $this->actingAs($this->user)
            ->post(route('rounds.service-providers.store', $this->round), [
                'type' => 'provider'
            ])->assertRedirect()
            ->assertSessionHasErrors([
                'entity_id',
                'data.presentation',
                'data.motivation',
                'user.phone_country_code',
                'user.phone',
                'user.bio'
            ]);
    }

    public function test_application_cannot_be_submitted_twice(): void
    {
        B2bApplication::factory()->has(Entity::factory())->create([
            'type'     => 'provider',
            'user_id'  => $this->user->id,
            'round_id' => $this->round->id
        ]);

        $this->actingAs($this->user)
            ->get(route('rounds.service-providers.create', $this->round))
            ->assertRedirect(route('home'))
            ->assertSessionHas('success', 'An application has been submitted for the same user!');
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->round = Round::factory()->create();
        $this->user = User::factory()->has(Link::factory()->count(5))->create();
    }
}
