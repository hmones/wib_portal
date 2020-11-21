<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Redirect, Auth};
use App\Models\{User, Entity};

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

    public function cookie(Request $request)
    {
        $status = $request->input('status');
        if($status){
            $request->session()->forget('consent-set');
            $request->session()->forget('statistics');
        }
        switch ($status) {
            case 'all':
                $request->session()->put('consent-set','true');
                $request->session()->put('statistics','true');
                break;
            default:
                $request->session()->put('consent-set','true');
                break;
        }
        return Redirect::back();
    }

    public function notifications(Request $request)
    {
        if($request->has('unread')){
            Auth::user()->unreadNotifications
                        ->where('type','!=','App\Notifications\MessageSent')
                        ->markAsRead();
        }
        $notifications = Auth::user()->notifications
                                     ->where('type','!=','App\Notifications\MessageSent')
                                     ->take(50);
        return view('notifications', compact('notifications'));
    }
}
