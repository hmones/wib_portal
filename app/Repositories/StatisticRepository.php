<?php

namespace App\Repositories;

use App\Models\Country;
use App\Models\Entity;
use App\Models\EntityType;
use App\Models\Sector;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StatisticRepository
{
    protected array $period;

    public function __construct($days = 7)
    {
        $this->period = CarbonPeriod::create(now()->subDays($days), now())->toArray();
    }

    public function getActiveUsers(): array
    {
        return $this->getResourceCountInPeriod(User::class, 'last_login');
    }

    protected function getResourceCountInPeriod(string $model, string $dateField): array
    {
        $data = [];
        foreach ($this->period as $day) {
            $data[] = [
                'day'            => $day->format('d M'),
                'entities_count' => resolve($model)->where($dateField, 'like', $day->format('Y-m-d%'))->count()
            ];
        }

        return [
            'days' => Arr::pluck($data, 'day'),
            'data' => Arr::pluck($data, 'entities_count')
        ];
    }

    public function getRegisteredUsers(): array
    {
        return $this->getResourceCountInPeriod(User::class, 'created_at');
    }

    public function getRegisteredEntities(): array
    {
        return $this->getResourceCountInPeriod(Entity::class, 'created_at');
    }

    public function getUsersByCountry(): array
    {
        return $this->getResourceRelatedModelCount(Country::class, 'users', 'name');
    }

    protected function getResourceRelatedModelCount(string $resourceModel, string $relationMethod, string $labelsField): array
    {
        $data = resolve($resourceModel)->select($labelsField)->whereHas($relationMethod)->withCount($relationMethod)->orderBy($relationMethod . '_count', 'desc')->take(10)->get();

        return [
            'labels' => $data->pluck($labelsField)->toArray(),
            'data'   => $data->pluck($relationMethod . '_count')->toArray()
        ];
    }

    public function getUsersByAge(): array
    {
        $data = User::select('birth_year', DB::raw('COUNT(*) as users_count'))->groupBy('birth_year')->orderBy('users_count', 'desc')->get();

        $ageData = [
            '0-17 Years'  => $data->whereBetween('age', [0, 17])->sum('users_count'),
            '18-24 Years' => $data->whereBetween('age', [18, 24])->sum('users_count'),
            '25-34 Years' => $data->whereBetween('age', [24, 34])->sum('users_count'),
            '35-44 Years' => $data->whereBetween('age', [35, 44])->sum('users_count'),
            '45-54 Years' => $data->whereBetween('age', [45, 54])->sum('users_count'),
            '55+ Years'   => $data->whereBetween('age', [55, 100])->sum('users_count')
        ];

        return [
            'age'  => array_keys($ageData),
            'data' => Arr::flatten($ageData)
        ];
    }

    public function getEntitiesBySector(): array
    {
        return $this->getResourceRelatedModelCount(Sector::class, 'entities', 'name');
    }

    public function getEntitiesByType(): array
    {
        return $this->getResourceRelatedModelCount(EntityType::class, 'entities', 'name');
    }

    public function getUsersBySector(): array
    {
        return $this->getResourceRelatedModelCount(Sector::class, 'users', 'name');
    }
}
