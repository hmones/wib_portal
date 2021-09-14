<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Redirect};

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::where('is_main', false)->orderByDesc('from')->take(10)->get();
        $mainEvent = Event::where('is_main', true)->orderByDesc('from')->first();

        return view('home', compact('events', 'mainEvent'));
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
