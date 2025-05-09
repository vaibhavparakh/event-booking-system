<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;

use Illuminate\Support\Facades\Log;

use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Event::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        try {
            $validated = $request->validated();

            $event = Event::create($validated);

            return response()->json([
                'message' => 'Event created successfully',
                'event'   => $event,
            ], 201);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
        return response()->json(['message' => 'Event creation failed'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return response()->json($event, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreEventRequest $request, Event $event)
    {
        try {
            $validated = $request->validated();
            
            $event->update($validated);
            
            return response()->json([
                'message' => 'Event updated successfully',
                'event'   => $event,
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
        return response()->json(['message' => 'Event not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return response()->json(['message' => 'Event deleted successfully'], 200);
    }
}
