<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ImpersonationTest extends TestCase
{
    use DatabaseTransactions;

    protected const IMPERSONATION_ROUTE = 'admin.impersonate.store';
    protected const USERS_ROUTE = 'admin.users';
    protected $user, $admin;

    public function testAdminCanImpersonateAUser(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->get(route(self::USERS_ROUTE))
            ->assertSee('secret user blue icon');

        $this->actingAs($this->admin, 'admin')
            ->post(route(self::IMPERSONATION_ROUTE), ['user_id' => $this->user->id])
            ->assertRedirect(route('home'));

        $this->assertAuthenticatedAs($this->user, 'web');
    }

    public function testUserCanNotAccessImpersonationRoutes(): void
    {
        $this->actingAs($this->user)->get(route(self::USERS_ROUTE))->assertRedirect(route('admin.login'));
        $this->actingAs($this->user)->post(route(self::IMPERSONATION_ROUTE), ['user_id' => $this->user->id])->assertRedirect(route('admin.login'));
    }

    public function testAdminCanQuitImpersonation(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->post(route(self::IMPERSONATION_ROUTE), ['user_id' => $this->user->id]);
        $this->assertNotNull(auth()->guard('web')->user());
        $this->assertAuthenticatedAs($this->user, 'web');
        $this->actingAs($this->admin, 'admin')->get(route('admin.impersonate.index'))
            ->assertRedirect(route(self::USERS_ROUTE));
        $this->assertNull(auth()->guard('web')->user());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::factory()->create();
        $this->user = User::factory()->create();
    }
}
