<?php

namespace App\Http\Controllers\Admin;

use App\Models\EntityType;
use App\Http\Controllers\Controller;
use App\Http\Requests\{FilterEntity, FilterUser};
use App\Models\Sector;
use App\Models\User;
use App\Models\Entity;

class DashboardController extends Controller
{
    public function index(){
        $users = User::count();
        $entities = Entity::count();
        $entityTypes = EntityType::count();
        $sectors = Sector::count();
        return view('admin.home', [
            "users" => $users,
            "entities" => $entities,
            "entityTypes" => $entityTypes,
            "sectors" => $sectors
        ]);
    }

    public function indexOptions(){
        $entityTypes = EntityType::all();
        $sectors = Sector::all();
        return view('admin.options', [
            'sectors' => $sectors,
            'entityTypes' => $entityTypes
        ]);
    }

    public function indexUsers(FilterUser $request){
        $filter = $request->validated();
        $users = User::where('name','like',$request->input('query').'%')->filter($filter)->paginate(12);
        return view('admin.users', compact(['users','request']));
    }

    public function indexEntities(FilterEntity $request){
        $filter = $request->validated();
        $entities = Entity::where('name','like', $request->input('query').'%')->filter($filter)->paginate(12);
        return view('admin.entities', compact(['entities','request']));
    }
}
