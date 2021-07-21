<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ImpersonationTest extends TestCase
{
    use DatabaseTransactions;

    protected $user, $admin;

    public function testAdminCanImpersonateAUser(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->get(route('admin.users'))
            ->assertSee('secret user blue icon');

        $this->actingAs($this->admin, 'admin')
            ->post(route('admin.impersonate.store'), ['user_id' => $this->user->id])
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($this->user, 'web');
    }

    public function testUserCanNotAccessImpersonationRoutes(): void
    {
        $this->actingAs($this->user)->get(route('admin.users'))->assertRedirect(route('admin.login'));
        $this->actingAs($this->user)->post(route('admin.impersonate.store'), ['user_id' => $this->user->id])->assertRedirect(route('admin.login'));
    }

    public function testAdminCanQuitImpersonation(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->post(route('admin.impersonate.store'), ['user_id' => $this->user->id]);
        $this->assertNotNull(auth()->guard('web')->user());
        $this->assertAuthenticatedAs($this->user, 'web');
        $this->actingAs($this->admin, 'admin')->get(route('admin.impersonate.index'))
            ->assertRedirect(route('admin.users'));
        $this->assertNull(auth()->guard('web')->user());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::factory()->create();
        $this->user = User::factory()->create();
    }
}
