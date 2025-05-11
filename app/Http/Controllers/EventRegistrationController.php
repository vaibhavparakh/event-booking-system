<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRegistrationRequest;

use App\Models\Attendee;
use App\Models\EventRegistration;
use App\Models\Event;

use Log;

class EventRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EventRegistration::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRegistrationRequest $request)
    {
        try {
            $validated = $request->validated();

            // check total registered attend for an event
            $totalAttendees = EventRegistration::where('event_id', $validated['event_id'])->count();
            
            // check if attendee is present
            $attendee = Attendee::find($validated['attendee_id']);
            if(!isset($attendee)) {
                return response()->json([
                    'message' => 'This attendee does not exist!',
                ], 201);
            }

            // get event capacity and check if slots are available
            $event = Event::find($validated['event_id']);
            if(!isset($event)) {
                return response()->json([
                    'message' => 'Event is expired or invalid!',
                ], 201);
            }

            if($totalAttendees < $event->capacity) {
                // check if already registered
                $registeredAttendee = EventRegistration::where('event_id', $validated['event_id'])->where('attendee_id', $validated['attendee_id'])->first();
                if(isset($registeredAttendee)) {
                    return response()->json([
                        'message' => 'Attendee already registered',
                        'registration' => $registeredAttendee,
                    ], 201);
                }

                // register attendee for event
                $registration = EventRegistration::create($validated);
                return response()->json([
                    'message' => 'Registration created successfully',
                    'registration'   => $registration,
                ], 201);
            } else {
                return response()->json([
                    'message' => 'All slots are booked',
                ], 201);
            }

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
        return response()->json(['message' => 'Registration creation failed'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRegistrationRequest $request, EventRegistration $registration)
    {
        // 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($eventId, $attendeeId)
    {
        if(EventRegistration::where('event_id', $eventId)->where('attendee_id', $attendeeId)->delete()) {
            return response()->json(['message' => 'Registration deleted successfully'], 200);
        }
        return response()->json(['message' => 'Registration not found'], 500);
    }

    public function attendees($eventId)
    {
        return EventRegistration::with('attendees')->where('event_id', $eventId)->paginate(15);
    }
}
