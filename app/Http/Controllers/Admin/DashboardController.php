<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\EntityType;
use App\Http\Controllers\Controller;
use App\Sector;
use Illuminate\Http\Request;
use App\User;
use App\Entity;

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

    public function indexUsers(){
        $users = User::latest()->paginate(12);
        return view('admin.users', compact('users'));
    }

    public function indexEntities(){
        $entities = Entity::latest()->paginate(12);
        return view('admin.entities', compact('entities'));
    }
}
