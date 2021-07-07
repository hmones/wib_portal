<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DataExportTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_export_users(): void
    {
        $adminUser = Admin::factory()->create();
        User::factory(3)->create();

        $this->actingAs($adminUser)
            ->get(route('admin.users', ['export' => 'xlsx']));
    }

    public function test_admin_can_export_entities(): void
    {
        $adminUser = Admin::factory()->create();
        Entity::factory(3)->create();
        $this->actingAs($adminUser)
            ->get(route('admin.entities', ['export' => 'xlsx']));
    }

    public function test_normal_user_can_not_export_entities(): void
    {
        $adminUser = Admin::factory()->create();
        Entity::factory(3)->create();
        $this->actingAs($adminUser)
            ->get(route('admin.entities', ['export' => 'xlsx']))
            ->assertRedirect(route('admin.login'));
    }

    public function test_normal_user_can_not_export_users(): void
    {
        $adminUser = Admin::factory()->create();
        User::factory(3)->create();

        $this->actingAs($adminUser)
            ->get(route('admin.users', ['export' => 'xlsx']))
            ->assertRedirect(route('admin.login'));
    }
}
