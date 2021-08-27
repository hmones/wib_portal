<?php

namespace Tests\Feature;

use App\Exports\EntitiesExport;
use App\Exports\UsersExport;
use App\Models\Admin;
use App\Models\Entity;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Maatwebsite\Excel\Facades\Excel;
use Tests\TestCase;

class DataExportTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_export_users(): void
    {
        Excel::fake();
        $adminUser = Admin::factory()->create();
        User::factory(3)->create(['name' => 'person name']);
        $this->actingAs($adminUser, 'admin')
            ->get(route('admin.users', ['export' => 'xlsx']));

        Excel::assertDownloaded('users.xlsx', function (UsersExport $export) {
            return $export->collection()->first()->name === 'person name';
        });
    }

    public function test_admin_can_export_entities(): void
    {
        Excel::fake();
        $adminUser = Admin::factory()->create();
        Entity::factory(3)->create(['name' => 'company name']);
        $this->actingAs($adminUser, 'admin')
            ->get(route('admin.entities', ['export' => 'xlsx']));

        Excel::assertDownloaded('entities.xlsx', function (EntitiesExport $export) {
            return $export->collection()->first()->name === 'company name';
        });
    }

    public function test_normal_user_can_not_export_entities(): void
    {
        $user = User::factory()->create();
        Entity::factory(3)->create();
        $this->actingAs($user)
            ->get(route('admin.entities', ['export' => 'xlsx']))
            ->assertRedirect(route('admin.login'));
    }

    public function test_normal_user_can_not_export_users(): void
    {
        $user = User::factory()->create();
        User::factory(3)->create();

        $this->actingAs($user)
            ->get(route('admin.users', ['export' => 'xlsx']))
            ->assertRedirect(route('admin.login'));
    }
}
