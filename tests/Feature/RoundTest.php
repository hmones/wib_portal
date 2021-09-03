<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Round;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Tests\TestCase;

class RoundTest extends TestCase
{
    use DatabaseTransactions;

    protected Model $admin;
    protected array $testData;
    protected string $indexRoute = 'admin.rounds.index';
    protected string $storeRoute = 'admin.rounds.store';

    public function test_rounds_are_viewed_successfully(): void
    {
        $round = Round::factory()->create();

        $this->actingAs($this->admin, 'admin')
            ->get(route($this->indexRoute))
            ->assertOk()
            ->assertSeeInOrder([
                $round->from->format('d-m-Y'),
                $round->to->format('d-m-Y'),
                $round->max_applicants,
                Str::title($round->status),
                $round->created_at->diffForHumans(),
                $round->updated_at->diffForHumans(),
            ]);
    }

    public function test_message_is_viewed_when_no_rounds(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->get(route($this->indexRoute))
            ->assertOk()
            ->assertSeeText('No rounds created yet!');
    }

    public function test_round_details_viewed_correctly(): void
    {
        $round = Round::factory()->create();

        $this->actingAs($this->admin, 'admin')
            ->get(route('admin.rounds.show', $round->id))
            ->assertOk()
            ->assertSeeInOrder([
                'Description',
                $round->description,
                'From',
                $round->from,
                'To',
                $round->to,
                'Maximum number of applicants',
                $round->max_applicants,
                'Status',
                Str::title($round->status),
                'Created at',
                $round->created_at,
                'Updated at',
                $round->updated_at,
                'Link',
                url('rounds/' . $round->id),
            ]);
    }

    public function test_round_is_stored_successfully(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->post(route($this->storeRoute), $this->testData)
            ->assertRedirect(route($this->indexRoute))
            ->assertSessionHas('success', 'The round is saved successfully!');

        $round = Round::first();

        $this->assertEquals(1, Round::count());
        $this->assertEquals($this->testData['description'], $round->description);
    }

    public function test_round_is_not_stored_when_dates_are_not_correct(): void
    {
        $invalidData = array_merge($this->testData, [
            'from' => now(),
            'to'   => now()->subHour()
        ]);

        $this->actingAs($this->admin, 'admin')
            ->post(route($this->storeRoute), $invalidData)
            ->assertSessionHasErrors(['from', 'to']);
    }


    public function test_round_is_not_stored_when_max_applicants_is_not_present(): void
    {
        Arr::forget($this->testData, ['max_applicants', 'description', 'location']);

        $this->actingAs($this->admin, 'admin')
            ->post(route($this->storeRoute), $this->testData)
            ->assertSessionHasErrors(['max_applicants']);
    }

    public function test_round_create_page_see_only_draft_and_published_status(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->get(route('admin.rounds.create'))
            ->assertOk()
            ->assertSee([Round::DRAFT, Round::PUBLISHED])
            ->assertDontSee([Str::title(Round::OPEN), Round::CLOSED]);
    }

    public function test_round_edit_page_see_all_statuses(): void
    {
        $round = Round::factory()->create();

        $this->actingAs($this->admin, 'admin')
            ->get(route('admin.rounds.edit', $round))
            ->assertOk()
            ->assertSee(Round::STATUSES);
    }

    public function test_admin_can_delete_round(): void
    {
        $round = Round::factory()->create();

        $this->actingAs($this->admin, 'admin')
            ->delete(route('admin.rounds.destroy', $round))
            ->assertRedirect(route($this->indexRoute))
            ->assertSessionHas('success', 'The round is deleted successfully!');

        $this->assertNull(Round::first());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::factory()->create();
        $this->testData = [
            'description'    => 'Event description',
            'from'           => now(),
            'to'             => now()->addWeek(),
            'max_applicants' => 10,
            'status'         => Round::DRAFT
        ];
    }
}
