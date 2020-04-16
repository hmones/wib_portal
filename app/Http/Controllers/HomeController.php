<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Entity;

class HomeController extends Controller
{
    public function index()
    {
        $users = User::with('sectors:name', 'country')->with(['avatar'=>function($query){
            $query->where('resolution', '300');
        }])->latest()->take(8)->get();
        $entities = Entity::with('sectors:name', 'primary_country')->with(['logo'=>function($query){
            $query->where('resolution', '300');
        }])->latest()->take(8)->get();
        return view('home', [
            'users' => $users,
            'entities' => $entities
        ]);
    }
}
