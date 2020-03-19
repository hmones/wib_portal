<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Entity;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::latest()->take(8)->get();
        $entities = Entity::latest()->take(8)->get();
        return view('home', [
            'users' => $users,
            'entities' => $entities
        ]);
    }
}
