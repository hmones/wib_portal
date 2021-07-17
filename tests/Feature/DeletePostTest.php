<?php

namespace Tests\Feature;

use App\Jobs\DeletePost;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class DeletePostTest extends TestCase
{
    use DatabaseTransactions;

    const DELETE_ROUTE = 'post.destroy';
    protected $user;
    protected $otherUser;
    protected $post;

    public function testResourcesRenderNormallyForInactiveComments(): void
    {
        $this->actingAs($this->user)->delete(route(self::DELETE_ROUTE, $this->post))->assertOk()->assertSee('Post Deleted Successfully');
        $this->actingAs($this->user)->get(route('home'))->assertOk()->assertDontSee($this->post->content);
        $this->actingAs($this->user)->get(route('notifications'))->assertOk()->assertDontSee($this->post->content);
    }

    public function testAUserCanDeleteTheirComment(): void
    {
        Queue::fake();

        $this->actingAs($this->user)
            ->delete(route(self::DELETE_ROUTE, $this->post))
            ->assertOk()
            ->assertSee('Post Deleted Successfully');

        Queue::assertPushed(DeletePost::class, 1);
    }

    public function testAUserCanNotDeleteCommentsOfOthers(): void
    {
        Queue::fake();

        $this->actingAs($this->otherUser)
            ->delete(route(self::DELETE_ROUTE, $this->post))
            ->assertStatus(Response::HTTP_FORBIDDEN);

        Queue::assertNothingPushed();
    }

    public function testCommentRelatedModelsAreDeletedWhenDeleted(): void
    {
        $this->actingAs($this->user)->delete(route('post.destroy', $this->post));

        $this->assertNull(Post::find($this->post->id));
        $this->assertNull(Comment::first());
        $this->assertNull(Reaction::first());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->otherUser = User::factory()->create();

        $this->post = Post::factory()
            ->has(
                Comment::factory()->count(3)->has(
                    Reaction::factory()->count(3)
                )
            )->for($this->user)->create();
    }
}
