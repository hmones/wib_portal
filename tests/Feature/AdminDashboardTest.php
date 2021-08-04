<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Country;
use App\Models\Entity;
use App\Models\EntityType;
use App\Models\Sector;
use App\Models\User;
use App\Repositories\StatisticRepository;
use Carbon\CarbonPeriod;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Arr;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use DatabaseTransactions;

    protected $admin;
    protected $statistics;

    public function test_nothing_is_shown_in_dashboard_when_database_is_empty(): void
    {
        $this->actingAs($this->admin, 'admin')->get(route('admin.home'))->assertOk();
    }

    public function test_active_users_history_is_correctly_retreived(): void
    {
        $expectedData = $this->createResourceInPeriod(User::class, 'last_login');

        $this->assertEquals($this->statistics->getActiveUsers(), $expectedData);
    }

    protected function createResourceInPeriod(string $model, string $dateField = 'created_at', int $RegisterPeriod = 7): array
    {
        $period = CarbonPeriod::create(now()->subDays($RegisterPeriod), now());
        $model = resolve($model);
        $model->factory()->create([$dateField => now()->subDays($RegisterPeriod + 1)]);
        $days = [];
        $data = [];

        foreach ($period as $day) {
            $model->factory()->create([$dateField => $day]);
            $days[] = $day->format('d M');
            $data[] = 1;
        }

        return compact(['days', 'data']);
    }

    public function test_registered_users_history_is_correctly_retreived(): void
    {
        $expectedData = $this->createResourceInPeriod(User::class);

        $this->assertEquals($this->statistics->getRegisteredUsers(), $expectedData);
    }

    public function test_registered_entities_history_is_correctly_retreived(): void
    {
        $expectedData = $this->createResourceInPeriod(Entity::class);

        $this->assertEquals($this->statistics->getRegisteredEntities(), $expectedData);
    }

    public function test_users_by_country_statistics_is_correctly_retreived(): void
    {
        $expectedData = $this->createResourceAndRelatedModels(User::class, Country::class, 'name', 'users');

        $this->assertEquals($this->statistics->getUsersByCountry(), $expectedData);
    }

    protected function createResourceAndRelatedModels(string $resourceModel, string $relatedModel, string $labelField, string $relationMethod, int $resourceCount = 2, int $relatedCount = 2): array
    {
        $relatedResources = resolve($relatedModel)
            ->factory()
            ->count($relatedCount)
            ->has(resolve($resourceModel)->factory()->count($resourceCount))
            ->create();

        return [
            'labels' => $relatedResources->pluck($labelField)->toArray(),
            'data'   => resolve($relatedModel)->withCount($relationMethod)->pluck($relationMethod . '_count')->toArray()
        ];
    }

    public function test_users_by_sector_statistics_is_correctly_retreived(): void
    {
        $expectedData = $this->createResourceAndRelatedModels(User::class, Sector::class, 'name', 'users');

        $this->assertEquals($this->statistics->getUsersBySector(), $expectedData);
    }

    public function test_entities_by_sector_statistics_is_correctly_retreived(): void
    {
        $expectedData = $this->createResourceAndRelatedModels(Entity::class, Sector::class, 'name', 'entities');

        $this->assertEquals($this->statistics->getEntitiesBySector(), $expectedData);
    }

    public function test_entities_by_type_statistics_is_correctly_retreived(): void
    {
        $expectedData = $this->createResourceAndRelatedModels(Entity::class, EntityType::class, 'name', 'entities');

        $this->assertEquals($this->statistics->getEntitiesByType(), $expectedData);
    }

    public function test_entities_by_revenue_statistics_is_correctly_retreived(): void
    {
        $expectedData = $this->createResourceWithData(Entity::class, 'revenue', ['Test1' => 2, 'Test2' => 1]);

        $this->assertEquals($this->statistics->getEntitiesByRevenue(), $expectedData);
    }

    protected function createResourceWithData(string $model, string $field, array $data): array
    {
        foreach ($data as $key => $record) {
            resolve($model)->factory()->count($record)->create([$field => $key]);
        }

        return [
            'data'   => Arr::flatten($data),
            'labels' => array_keys($data)
        ];
    }

    public function test_entities_by_turnover_statistics_is_correctly_retreived(): void
    {
        $expectedData = $this->createResourceWithData(Entity::class, 'turn_over', ['100' => 2, '300' => 2]);

        $this->assertEquals($this->statistics->getEntitiesByTurnover(), $expectedData);
    }

    public function test_entities_by_size_statistics_is_correctly_retreived(): void
    {
        $expectedData = $this->createResourceWithData(Entity::class, 'entity_size', ['2' => 9, '>10' => 2]);

        $this->assertEquals($this->statistics->getEntitiesBySize(), $expectedData);
    }

    public function test_entities_by_business_type_statistics_is_correctly_retreived(): void
    {
        $expectedData = $this->createResourceWithData(Entity::class, 'business_type', ['new' => 12, 'old' => 1]);

        $this->assertEquals($this->statistics->getEntitiesByBusinessType(), $expectedData);
    }

    public function test_users_by_age_statistics_is_correctly_retreived(): void
    {
        User::factory()->count(2)->create(['birth_year' => now()->subYears(20)->year]);
        User::factory()->create(['birth_year' => now()->subYears(50)->year]);

        $expectedData = [
            'age' => [
                '0-17 Years',
                '18-24 Years',
                '25-34 Years',
                '35-44 Years',
                '45-54 Years',
                '55+ Years',
            ],

            'data' => [0, 2, 0, 0, 1, 0]
        ];

        $this->assertEquals($this->statistics->getUsersByAge(), $expectedData);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = Admin::factory()->create();
        $this->statistics = new StatisticRepository();
    }
}
