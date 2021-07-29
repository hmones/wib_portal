<?php

namespace App\Http\Controllers\Admin;

use App\Exports\EntitiesExport;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\{FilterEntity, FilterUser};
use App\Models\Entity;
use App\Models\EntityType;
use App\Models\Sector;
use App\Models\User;
use App\Repositories\StatisticRepository;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public function index()
    {
        $statisticRepository = new StatisticRepository();

        return view('admin.home', [
            'activeUsers'        => $statisticRepository->getActiveUsers(),
            'usersCountries'     => $statisticRepository->getUsersByCountry(),
            'usersAge'           => $statisticRepository->getUsersByAge(),
            'usersSectors'       => $statisticRepository->getUsersBySector(),
            'entitiesSectors'    => $statisticRepository->getEntitiesBySector(),
            'entitiesTypes'      => $statisticRepository->getEntitiesByType(),
            'registeredUsers'    => $statisticRepository->getRegisteredUsers(),
            'registeredEntities' => $statisticRepository->getRegisteredEntities(),
            'entitiesRevenue'    => $statisticRepository->getEntitiesByRevenue(),
            'entitiesType'       => $statisticRepository->getEntitiesByBusinessType(),
            'entitiesTurnover'   => $statisticRepository->getEntitiesByTurnover(),
            'entitiesSize'       => $statisticRepository->getEntitiesBySize()
        ]);
    }

    public function indexOptions()
    {
        $entityTypes = EntityType::all();
        $sectors = Sector::all();
        return view('admin.options', [
            'sectors'     => $sectors,
            'entityTypes' => $entityTypes
        ]);
    }

    public function indexUsers(FilterUser $request)
    {
        $users = User::where('name', 'like', $request->input('query') . '%')->filter($request->validated())->latest();

        return $request->export === 'xlsx'
            ? Excel::download(new UsersExport($users->get()), 'users.xlsx')
            : view('admin.users', ['users' => $users->paginate(20), 'request' => $request->validated()]);
    }

    public function indexEntities(FilterEntity $request)
    {
        $entities = Entity::where('name', 'like', $request->input('query') . '%')->filter($request->validated())->latest();

        return $request->export === 'xlsx'
            ? Excel::download(new EntitiesExport($entities->get()), 'entities.xlsx')
            : view('admin.entities', ['entities' => $entities->paginate(20), 'request' => $request->validated()]);
    }
}
