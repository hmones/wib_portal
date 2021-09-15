<?php

namespace Tests\Feature;

use App\Facades\FileStorage;
use App\Models\Admin;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Tests\TestCase;

class EventsTest extends TestCase
{
    use DatabaseTransactions;

    protected Model $admin;
    protected array $testData;
    protected string $indexRoute = 'admin.events.index';
    protected string $storeRoute = 'admin.events.store';
    protected string $testLink = 'https://www.google.com';

    public function test_events_are_viewed_successfully(): void
    {
        $event = Event::factory()->create();

        $this->actingAs($this->admin, 'admin')
            ->get(route($this->indexRoute))
            ->assertOk()
            ->assertSeeInOrder([
                $event->title,
                $event->from->format('d-m-Y'),
                $event->to->format('d-m-Y'),
                $event->location,
                $event->created_at->diffForHumans(),
                $event->updated_at->diffForHumans(),
            ]);
    }

    public function test_message_is_viewed_when_no_events(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->get(route($this->indexRoute))
            ->assertOk()
            ->assertSeeText('No events created yet!');
    }

    public function test_event_details_viewed_correctly(): void
    {
        $event = Event::factory()->create();

        $this->actingAs($this->admin, 'admin')
            ->get(route('admin.events.show', $event->id))
            ->assertOk()
            ->assertSeeInOrder([
                'Image',
                $event->image,
                'Title',
                $event->title,
                'Description',
                $event->description,
                'From',
                $event->from,
                'To',
                $event->to,
                'Location',
                $event->location,
                'Button Text',
                $event->button_text,
                'Link',
                $event->link,
                'is Highlighted',
                $event->is_main ? 'Yes' : 'No',
                'Created at',
                $event->created_at,
                'Updated at',
                $event->updated_at,
            ]);
    }

    public function test_event_is_stored_successfully(): void
    {
        FileStorage::shouldReceive('store')->andReturn($this->testLink);

        $this->actingAs($this->admin, 'admin')
            ->post(route($this->storeRoute), $this->testData)
            ->assertRedirect(route($this->indexRoute))
            ->assertSessionHas('success', 'The event is saved successfully!');

        $event = Event::first();

        $this->assertEquals(1, Event::count());
        $this->assertEquals($this->testLink, $event->image);
    }

    public function test_event_is_not_stored_when_dates_are_not_correct(): void
    {
        $invalidData = array_merge($this->testData, [
            'from' => now(),
            'to' => now()->subHour()
        ]);

        $this->actingAs($this->admin, 'admin')
            ->post(route($this->storeRoute), $invalidData)
            ->assertSessionHasErrors(['from', 'to']);
    }

    public function test_event_is_not_stored_when_link_and_button_text_are_not_together(): void
    {
        Arr::forget($this->testData, 'button_text');

        $this->actingAs($this->admin, 'admin')
            ->post(route($this->storeRoute), $this->testData)
            ->assertSessionHasErrors(['button_text']);
    }

    public function test_event_is_not_stored_when_image_size_is_large(): void
    {
        $invalidData = array_merge($this->testData, [
            'image' => UploadedFile::fake()->image('name.png')->size(2050)
        ]);

        $this->actingAs($this->admin, 'admin')
            ->post(route($this->storeRoute), $invalidData)
            ->assertSessionHasErrors(['image']);
    }

    public function test_event_is_not_stored_when_title_is_not_present(): void
    {
        Arr::forget($this->testData, ['title', 'description', 'location']);

        $this->actingAs($this->admin, 'admin')
            ->post(route($this->storeRoute), $this->testData)
            ->assertSessionHasErrors(['title']);
    }

    public function test_event_is_updated_even_if_image_is_not_present(): void
    {
        $event = Event::factory()->create();
        Arr::forget($this->testData, 'image');

        $this->actingAs($this->admin, 'admin')
            ->put(route('admin.events.update', $event), $this->testData)
            ->assertRedirect(route($this->indexRoute))
            ->assertSessionHas('success', 'The event is updated successfully!');

        $event->refresh();

        $this->assertEquals($this->testData['title'], $event->title);
    }

    public function test_admin_can_delete_event(): void
    {
        $event = Event::factory()->create();
        FileStorage::shouldReceive('destroy')->andReturn(true);

        $this->actingAs($this->admin, 'admin')
            ->delete(route('admin.events.destroy', $event))
            ->assertRedirect(route($this->indexRoute))
            ->assertSessionHas('success', 'The event is deleted successfully!');

        $this->assertNull(Event::first());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::factory()->create();
        $this->testData = [
            'title' => 'my title',
            'image' => UploadedFile::fake()->image('photo.png'),
            'description' => 'my description',
            'link'        => $this->testLink,
            'button_text' => 'read more',
            'location'    => 'Cairo',
            'from'        => now(),
            'to'          => now()->addWeek()
        ];
    }
}
