<?php

namespace Tests\Feature;

use App\Http\Livewire\ShowAdmins;
use App\Models\Admin;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Livewire\Livewire;
use Tests\TestCase;

class AdminUserCreationTest extends TestCase
{
    use DatabaseTransactions;

    protected $admin;

    public function testAdminCanCreateAnotherAdmin(): void
    {
        Livewire::test(ShowAdmins::class, [
            'name'            => 'testAdmin',
            'email'           => 'test@test.test',
            'password'        => 'Password123',
            'confirmPassword' => 'Password123'

        ])->call('store');

        $this->assertNotNull(Admin::where('name', 'testAdmin')->first());
    }

    public function testAdminCanNotCreateAnotherAdminWhenDataIsInvalid(): void
    {
        Livewire::test(ShowAdmins::class, [
            'name'            => 'testAdmin',
            'email'           => 'test',
            'password'        => 'Passwor',
            'confirmPassword' => 'Password123'

        ])->call('store')
            ->assertHasErrors(['email', 'password']);
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

        Livewire::test(ShowAdmins::class)->call('destroy', $admin->id);

        $this->assertNull(Admin::find($admin->id));
        $this->assertNull(User::where('approved_by', $admin->id)->first());
        $this->assertNull(Entity::where('approved_by', $admin->id)->first());
    }

    public function testAdminCanUpdateTheirInformation(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->patch(route('admin.admins.update', $this->admin), [
                'name'                  => 'testAdmin',
                'email'                 => 'test@test.test',
                'password'              => 'Password123',
                'password_confirmation' => 'Password123'
            ])->assertRedirect(route('admin.home'))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success');
    }

    public function testAdminCanUpdateTheirInformationEvenIfPasswordIsEmpty(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->put(route('admin.admins.update', $this->admin), [
                'name'  => 'testAdmin',
                'email' => 'test@test.test',
            ])->assertRedirect(route('admin.home'))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success');
    }

    public function testAdminCanNotUpdateTheirInformationWithInvalidData(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->put(route('admin.admins.update', $this->admin), [
                'name'                  => 'testAdmin',
                'email'                 => 'test',
                'password'              => 'Passwor',
                'password_confirmation' => 'Password123'
            ])->assertSessionHasErrors(['email', 'password']);
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
