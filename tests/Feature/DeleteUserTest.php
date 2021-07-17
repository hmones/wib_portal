<?php

namespace Tests\Feature;

use App\Models\City;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Entity;
use App\Models\EntityType;
use App\Models\Post;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanBeDeleted()
    {
        $country = Country::factory()->create();
        $city = City::factory()->create();
        $entityType = EntityType::factory()->create(['name' => 'business']);
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        Entity::factory()->count(9)->create([
            'entity_type_id'     => $entityType->id,
            'primary_country_id' => $country->id,
            'primary_city_id'    => $city->id
        ]);
        $entity = Entity::factory()->create([
            'owned_by'           => $user1->id,
            'entity_type_id'     => $entityType->id,
            'primary_country_id' => $country->id,
            'primary_city_id'    => $city->id
        ]);

        $user1->entities()->attach($entity->id, ['relation_type' => 'Owner', 'relation_active' => 1]);

        $user1Posts = Post::factory()->count(2)->has(
            Comment::factory()->count(3)->has(
                Reaction::factory()->count(3)
            )
        )->create(['user_id' => $user1->id, 'country_id' => $country->id]);

        Post::factory()->count(2)->has(
            Comment::factory()->count(3)->has(
                Reaction::factory()->count(3)
            )
        )->create(['user_id' => $user2->id, 'country_id' => $country->id]);


        $this->actingAs($user1)->get('/home')->assertViewIs('home');

        $this->actingAs($user1)->delete($user1->path);

        $this->assertEquals(User::find($user1->id), null);

        $this->assertEquals(Post::whereIn('id', $user1Posts->pluck('id'))->count(), 0);

        $this->assertEquals(Comment::whereIn('id', $user1Posts->pluck('id'))->count(), 0);

        $this->assertEquals(Reaction::whereIn('id', $user1Posts->pluck('id'))->count(), 0);

        $this->assertEquals(Entity::where('id', $entity->id)->first()->owned_by, null);
    }
}
