<?php

namespace Tests\Feature;

use App\Http\Livewire\ShowAdmins;
use App\Models\Admin;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Livewire\Livewire;
use Tests\TestCase;

class AdminUserCreationTest extends TestCase
{
    use DatabaseTransactions;

    const UPDATE_ROUTE = 'admin.admins.update';
    protected $admin;
    protected $data = [
        'name'            => 'testAdmin',
        'email'           => 'test@test.test',
        'password'        => 'Password123',
        'confirmPassword' => 'Password123'
    ];

    public function testAdminCanCreateAnotherAdmin(): void
    {
        Livewire::test(ShowAdmins::class, $this->data)->call('store');

        $this->assertNotNull(Admin::where('name', 'testAdmin')->first());
    }

    public function testAdminCanNotCreateAnotherAdminWhenDataIsInvalid(): void
    {
        Livewire::test(ShowAdmins::class, array_merge($this->data, [
            'email'    => 'test',
            'password' => 'Pass',
        ]))->call('store')
            ->assertHasErrors(['email', 'password']);
    }

    public function testAdminCanViewOtherAdmins(): void
    {
        $this->withoutExceptionHandling();
        $adminUser = Admin::factory()->create();
        $this->actingAs($this->admin, 'admin')
            ->get(route('admin.admins.index'))
            ->assertSeeInOrder([$adminUser->name, $adminUser->email, $adminUser->created_at->diffForHumans()]);
    }

    public function testAdminCanDeleteOtherAdmins(): void
    {
        $adminUser = Admin::factory()->create();

        Livewire::test(ShowAdmins::class)->call('destroy', $adminUser->id);

        $this->assertNull(Admin::find($adminUser->id));
        $this->assertNull(User::where('approved_by', $adminUser->id)->first());
        $this->assertNull(Entity::where('approved_by', $adminUser->id)->first());
    }

    public function testAdminCanUpdateTheirInformation(): void
    {
        Arr::forget($this->data, 'confirmPassword');
        $this->actingAs($this->admin, 'admin')
            ->patch(route(self::UPDATE_ROUTE, $this->admin), array_merge($this->data, ['password_confirmation' => 'Password123']))
            ->assertRedirect(route('admin.home'))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success');
    }

    public function testAdminCanUpdateTheirInformationEvenIfPasswordIsEmpty(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->put(route(self::UPDATE_ROUTE, $this->admin), [
                'name'  => 'testAdmin',
                'email' => 'test@test.test',
            ])->assertRedirect(route('admin.home'))
            ->assertSessionHasNoErrors()
            ->assertSessionHas('success');
    }

    public function testAdminCanNotUpdateTheirInformationWithInvalidData(): void
    {
        $this->actingAs($this->admin, 'admin')
            ->put(route(self::UPDATE_ROUTE, $this->admin), array_merge($this->data, [
                'email'    => 'wrong_email.com',
                'password' => 'differentPassword',
            ]))->assertSessionHasErrors(['email', 'password']);
    }

    public function testAdminCanNotUpdateOtherAdminInformation(): void
    {
        $adminUser = Admin::factory()->create();
        $this->actingAs($this->admin, 'admin')
            ->put(route(self::UPDATE_ROUTE, $adminUser), $this->data)
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::factory()->create();
    }
}
