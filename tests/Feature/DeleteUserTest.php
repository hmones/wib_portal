<?php

namespace Tests\Feature;

use App\Jobs\DeleteUser;
use App\Models\Admin;
use App\Models\Comment;
use App\Models\Entity;
use App\Models\Link;
use App\Models\Message;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use DatabaseTransactions;

    protected $user1;
    protected $user2;
    protected $entityUser1;
    protected $entityOwnedUser1;
    protected $entityUser2;
    protected $entityOwnedUser2;
    protected $postUser1;
    protected $postUser2;
    protected $messageUser1;
    protected $messageUser2;

    public function testResourcesRenderNormallyForInactiveUsers(): void
    {
        $adminUser = Admin::factory()->create();
        $path = $this->user1->path;
        $name = $this->user1->name;
        $id = $this->user1->id;
        $this->user1->update(['active' => 0]);

        $this->actingAs($this->user2)->get(route('messenger'))->assertOk()->assertDontSee($name);
        $this->actingAs($this->user2)->post(route('messages.seen'), compact('id'))->assertOk();
        $this->actingAs($adminUser, 'admin')->get('admin.users')->assertOk()->assertDontSee($name);
        $this->actingAs($this->user2)->get(route('post.index'))->assertOk()->assertDontSee($name)->assertSeeText('Deleted User');
        $this->actingAs($this->user2)->get(route('notifications'))->assertOk()->assertDontSee($name);
        $this->actingAs($this->user2)->get($path)->assertNotFound();
        $this->actingAs($this->user2)->get(route('profile.index'))->assertOk()->assertDontSee($name);
        $this->actingAs($this->user2)->get(route('entity.index'))->assertOk();
        $this->actingAs($this->user2)->get($this->entityUser1->path)->assertOk()->assertDontSee($name);
        $this->actingAs($this->user2)->get($this->entityOwnedUser1->path)->assertOk()->assertDontSee($name);
    }

    public function testAUserCanDeleteThemselvesSuccessfully(): void
    {
        Queue::fake();

        $this->actingAs($this->user1)
            ->delete($this->user1->path)
            ->assertRedirect(route('login'))
            ->assertSessionHas('success');

        Queue::assertPushed(DeleteUser::class, 1);
    }

    public function testUserRelatedModelsAreDeletedWhenUserIsDeleted(): void
    {
        $userId = $this->user1->id;
        Post::factory()->has(Comment::factory()->has(Reaction::factory()->count(2))->for($this->user1))->create();
        $this->actingAs($this->user1)->delete($this->user1->path);

        $this->entityOwnedUser1->refresh();
        $this->entityUser1->refresh();

        $this->assertNull(User::find($userId));
        $this->assertNull(Link::where('linkable_id', $userId)->where('linkable_type', 'App\Models\User')->first());
        $this->assertNull(Sector::whereHas('users')->first());
        $this->assertNull($this->entityUser1->users()->first());
        $this->assertNull($this->entityOwnedUser1->owned_by);
        $this->assertNull(Message::where('from_id', $userId)->orWhere('to_id', $userId)->first());
        $this->assertNull(Post::find($this->postUser1->id));
        $this->assertNull(Comment::where('commentable_id', $this->postUser1->id)->where('commentable_type', 'App\Models\Post')->first());
        $this->assertNull(Comment::where('user_id', $userId)->first());
        $this->assertNull(Reaction::where('reactionable_id', $this->postUser1->id)->where('reactionable_id', 'App\Models\Post')->first());
        $this->assertNull(Reaction::where('user_id', $userId)->first());
        $this->assertNotNull(Post::find($this->postUser2->id));
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user1 = User::factory()->has(Link::factory()->count(3))->has(Sector::factory()->count(3))->create();
        $this->user2 = User::factory()->create();

        $this->entityUser1 = Entity::factory()->create();
        $this->user1->entities()->attach($this->entityUser1, ['relation_type' => 'Manager', 'relation_active' => 1]);
        $this->entityOwnedUser1 = Entity::factory()->create(['owned_by' => $this->user1->id]);

        $this->entityUser2 = Entity::factory()->create();
        $this->user2->entities()->attach($this->entityUser2, ['relation_type' => 'Manager', 'relation_active' => 1]);
        $this->entityOwnedUser2 = Entity::factory()->create(['owned_by' => $this->user2->id]);

        $this->messageUser1 = Message::factory()->create(['from_id' => $this->user1, 'to_id' => $this->user2]);
        $this->messageUser2 = Message::factory()->create(['from_id' => $this->user2, 'to_id' => $this->user1]);

        $this->postUser1 = Post::factory()->has(
            Comment::factory()->count(3)->has(
                Reaction::factory()->count(3)
            )
        )->for($this->user1)->create();

        $this->postUser2 = Post::factory()->has(
            Comment::factory()->count(3)->has(
                Reaction::factory()->count(3)
            )
        )->for($this->user2)->create();
    }
}
