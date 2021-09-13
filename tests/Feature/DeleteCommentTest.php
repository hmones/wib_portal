<?php

namespace Tests\Feature;

use App\Jobs\DeleteComment;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class DeleteCommentTest extends TestCase
{
    use DatabaseTransactions;

    const DELETE_ROUTE = 'comment.destroy';
    protected $user;
    protected $otherUser;
    protected $comment;

    public function testResourcesRenderNormallyForInactiveComments(): void
    {
        $this->actingAs($this->user)->delete(route(self::DELETE_ROUTE, $this->comment))->assertOk()->assertSee('Comment Deleted Successfully');
        $this->actingAs($this->user)->get(route('post.index'))->assertOk()->assertDontSee($this->comment->content);
        $this->actingAs($this->user)->get(route('notifications'))->assertOk()->assertDontSee($this->comment->content);
    }

    public function testAUserCanDeleteTheirComment(): void
    {
        Queue::fake();

        $this->actingAs($this->user)
            ->delete(route(self::DELETE_ROUTE, $this->comment))
            ->assertOk()
            ->assertSee('Comment Deleted Successfully');

        Queue::assertPushed(DeleteComment::class, 1);
    }

    public function testAUserCanNotDeleteCommentsOfOthers(): void
    {
        Queue::fake();

        $this->actingAs($this->otherUser)
            ->delete(route(self::DELETE_ROUTE, $this->comment))
            ->assertStatus(Response::HTTP_FORBIDDEN);

        Queue::assertNothingPushed();
    }

    public function testCommentRelatedModelsAreDeletedWhenDeleted(): void
    {
        $this->actingAs($this->user)->delete(route('comment.destroy', $this->comment));

        $this->assertNull(Comment::find($this->comment->id));
        $this->assertNull(Reaction::where('reactionable_id', $this->comment->id)->where('reactionable_id', 'App\Models\Comment')->first());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
        $this->otherUser = User::factory()->create();

        Post::factory()
            ->has(
                Comment::factory()->count(3)->has(
                    Reaction::factory()->count(3)
                )
            )->has(
                Comment::factory()->for($this->user)->has(
                    Reaction::factory()->count(3)
                )
            )->for($this->user)->create();

        $this->comment = Comment::where('user_id', $this->user->id)->first();
    }
}
