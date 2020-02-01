<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Entity;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::latest()->take(12)->get();
        $entities = Entity::latest()->take(12)->get();
        $user = \Auth::user();
        return view('profile.index',[
            'users' => $users,
            'entities' => $entities,
            'user' => $user,
        ]);
    }
}
