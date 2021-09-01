<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventStore;
use App\Http\Requests\EventUpdate;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::paginate(15);

        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(EventStore $request)
    {
        return response($request->all());
    }

    public function show(Event $event)
    {
        return view('admin.events.show', compact('event'));
    }

    public function edit(Event $event)
    {
        return view('admin.events.create', compact('event'));
    }

    public function update(EventUpdate $request, Event $event)
    {
        return response($request->all());
    }

    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->to(route('admin.events.index'));
    }
}
