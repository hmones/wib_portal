<?php

namespace Tests\Feature;

use App\Http\Livewire\B2bApplicants;
use App\Models\Admin;
use App\Models\B2bApplication;
use App\Models\Entity;
use App\Models\Link;
use App\Models\Round;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Livewire\Livewire;
use Tests\TestCase;

class ApplicationTest extends TestCase
{
    use DatabaseTransactions;

    protected const CREATE_ROUTE = 'rounds.service-providers.create';
    protected const INDEX_ROUTE = 'rounds.service-providers.index';
    protected $round, $user;

    public function test_guests_cannot_access_application(): void
    {
        $this->get(route(self::CREATE_ROUTE, $this->round))
            ->assertRedirect(route('login'));
    }

    public function test_application_is_displayed_with_user_data(): void
    {
        $this->round->update(['status' => Round::OPEN]);

        $this->actingAs($this->user)
            ->get(route(self::CREATE_ROUTE, $this->round))
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
            ->get(route(self::CREATE_ROUTE, $this->round))
            ->assertRedirect(route('home'))
            ->assertSessionHas('success', 'An application has been submitted for the same user!');
    }

    public function test_application_cannot_be_viewed_if_round_is_draft_or_closed(): void
    {
        $this->round->update(['status' => Round::DRAFT]);

        $this->actingAs($this->user)
            ->get(route(self::CREATE_ROUTE, $this->round))
            ->assertRedirect(route(self::INDEX_ROUTE, $this->round));

        $this->round->update(['status' => Round::CLOSED]);

        $this->actingAs($this->user)
            ->get(route(self::CREATE_ROUTE, $this->round))
            ->assertRedirect(route(self::INDEX_ROUTE, $this->round));
    }

    public function test_list_of_providers_cannot_be_viewed_if_round_is_draft_or_open(): void
    {
        $this->round->update(['status' => Round::DRAFT]);

        $this->actingAs($this->user)
            ->get(route(self::INDEX_ROUTE, $this->round))
            ->assertRedirect(route('home'));

        $this->round->update(['status' => Round::OPEN]);

        $this->actingAs($this->user)
            ->get(route(self::INDEX_ROUTE, $this->round))
            ->assertRedirect(route(self::CREATE_ROUTE, $this->round));
    }

    public function test_list_of_providers_contains_only_accepted_users_when_status_is_closed(): void
    {
        $this->round->update(['status' => Round::CLOSED]);

        $application1 = B2bApplication::factory()->create(['status' => B2bApplication::SUBMITTED, 'round_id' => $this->round->id]);
        $application2 = B2bApplication::factory()->create(['status' => B2bApplication::DECLINED, 'round_id' => $this->round->id]);
        $application = B2bApplication::factory()->has(User::factory())->has(Entity::factory())->create(['status' => B2bApplication::ACCEPTED, 'round_id' => $this->round->id]);

        $this->actingAs($this->user)
            ->get(route(self::INDEX_ROUTE, $this->round))
            ->assertOk()
            ->assertSee([$application->user->name, $application->entity->name])
            ->assertDontSee([$application1->user->name, $application2->user->name]);

        $this->round->update(['status' => Round::OPEN]);

        $this->actingAs($this->user)
            ->get(route(self::INDEX_ROUTE, $this->round))
            ->assertRedirect(route(self::CREATE_ROUTE, $this->round));
    }

    public function test_admin_can_view_applications(): void
    {
        $application = B2bApplication::factory()->create();

        $this->actingAs($this->admin, 'admin')
            ->get(route('admin.b2b-applications.index'))
            ->assertSeeInOrder([
                $application->user->name,
                $application->user->email,
                $application->entity->name,
                $application->created_at->diffForHumans(),
                $application->updated_at->diffForHumans()
            ]);
    }

    public function test_admin_can_delete_applications(): void
    {
        $application = B2bApplication::factory()->create();

        Livewire::test(B2bApplicants::class)->call('destroy', $application->id);

        $this->assertNull(B2bApplication::find($application->id));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->round = Round::factory()->create();
        $this->user = User::factory()->has(Link::factory()->count(5))->create();
        $this->admin = Admin::factory()->create();
    }
}
