<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Http\Response;
use Tests\TestCase;

class AdminUserCreationTest extends TestCase
{
    protected $admin;

    public function testAdminCanCreateAnotherAdmin(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->post(route('admin.admins.store'), [
                'name'                  => 'testAdmin',
                'email'                 => 'test@test.test',
                'password'              => 'Password123',
                'password_confirmation' => 'Password123'
            ])->assertRedirect(route('admin.admins.index'))
            ->assertSessionHasNoErrors();
    }

    public function testAdminCanNotCreateAnotherAdminWhenDataIsInvalid(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->post(route('admin.admins.store'), [
                'name'                  => 'testAdmin',
                'email'                 => 'test@test',
                'password'              => 'Passwor',
                'password_confirmation' => 'Password123'
            ])->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function testAdminCanViewOtherAdmins(): void
    {
        $admin = Admin::factory()->create();
        $this->actingAs($this->admin, 'admin')
            ->post(route('admin.admins.index'))
            ->assertSeeInOrder([$admin->name, $admin->email, $admin->created_at]);
    }

    public function testAdminCanDeleteOtherAdmins(): void
    {
        $admin = Admin::factory()->create();
        $this->actingAs($this->admin, 'admin')
            ->delete(route('admin.admins.destroy', $admin))
            ->assertSessionHas('success')
            ->assertOk();
    }

    public function testAdminCanUpdateTheirInformation(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->put(route('admin.admins.update', $this->admin), [
                'name'                  => 'testAdmin',
                'email'                 => 'test@test.test',
                'password'              => 'Password123',
                'password_confirmation' => 'Password123'
            ])->assertRedirect(route('dashboard'))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success');
    }

    public function testAdminCanNotUpdateTheirInformationWithInvalidData(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->put(route('admin.admins.update', $this->admin), [
                'name'                  => 'testAdmin',
                'email'                 => 'test@test',
                'password'              => 'Passwor',
                'password_confirmation' => 'Password123'
            ])->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function testAdminCanNotUpdateOtherAdminInformation(): void
    {
        $admin = Admin::factory()->create();
        $this->actingAs($this->admin, 'admin')
            ->put(route('admin.admins.update', $admin), [
                'name'                  => 'testAdmin',
                'email'                 => 'test@test.test',
                'password'              => 'Password123',
                'password_confirmation' => 'Password123'
            ])->assertStatus(Response::HTTP_FORBIDDEN);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::factory()->create();
    }
}
