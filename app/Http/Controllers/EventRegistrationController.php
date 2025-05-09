<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRegistrationRequest;

use App\Models\Attendee;
use App\Models\EventRegistration;

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
    public function store(EventRegistrationRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            
            // create or update attendee
            $validated['attendee_id'] = $this->storeAttendee($validated);

            $registration = EventRegistration::create($validated);

            return response()->json([
                'message' => 'Registration created successfully',
                'registration'   => $registration,
            ], 201);

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
        try {
            $validated = $request->validated();
            
            $registration->update($validated);
            
            return response()->json([
                'message' => 'Registration updated successfully',
                'Registration' => $registration,
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
        return response()->json(['message' => 'Registration not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EventRegistration $registration)
    {
        $registration->delete();
        return response()->json(['message' => 'Registration deleted successfully'], 200);
    }

    public function storeAttendee(array $data)
    {
        // Check if the attendee already exists
        $attendee = Attendee::where('mobile_number', $data['mobile_number'])->first();

        if ($attendee) {
            // Update existing attendee
            $attendee->update($data);
            return $attendee->id;
        }

        // Create new attendee
        $attendee = Attendee::create($data);
        return $attendee->id;
    }
}
