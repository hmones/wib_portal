<?php

namespace App\Http\Controllers;

use App\Facades\FileStorage;
use App\Http\Requests\EventStore;
use App\Http\Requests\EventUpdate;
use App\Models\Event;

class EventController extends Controller
{
    protected const INDEX_ROUTE = 'admin.events.index';

    public function index()
    {
        $events = Event::latest()->paginate(15);

        return view(self::INDEX_ROUTE, compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(EventStore $request)
    {
        Event::create(array_merge($request->safe()->toArray(), ['image' => FileStorage::store($request->image, 500, 700)]));

        return redirect(route(self::INDEX_ROUTE))->with(['success' => 'The event is saved successfully!']);
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
        $event->update(
            $request->image
                ? array_merge($request->safe()->toArray(), ['image' => FileStorage::store($request->image, 500, 700)])
                : $request->safe()->toArray()
        );

        return redirect(route(self::INDEX_ROUTE))->with(['success' => 'The event is updated successfully!']);
    }

    public function destroy(Event $event)
    {
        FileStorage::destroy($event->image);
        $event->delete();

        return redirect(route(self::INDEX_ROUTE))->with(['success' => 'The event is deleted successfully!']);
    }
}
