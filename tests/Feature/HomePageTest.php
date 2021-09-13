<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use DatabaseTransactions;

    public function test_homepage_doesnt_display_events_when_no_events(): void
    {
        $this->get(route('home'))
            ->assertDontSeeText('NEXT EVENT')
            ->assertDontSeeText('Upcoming Events');
    }

    public function test_events_are_viewed_successfully_on_homepage(): void
    {
        [$firstEvent, $secondEvent, $thirdEvent] = Event::factory()->count(3)->create();

        $this->get(route('home'))
            ->assertSeeTextInOrder([
                $firstEvent->title,
                $firstEvent->location,
                $firstEvent->description,
                $firstEvent->location,
                $firstEvent->title,
                $secondEvent->location,
                $secondEvent->title,
                $thirdEvent->location,
                $thirdEvent->title,
            ]);
    }

    public function test_signUp_section_is_displayed_for_guest_user(): void
    {
        $this->get(route('home'))
            ->assertSeeText('Sign up today');
    }

    public function test_signUp_section_is_not_displayed_for_a_user(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('home'))
            ->assertDontSeeText('Sign up today');
    }
}
