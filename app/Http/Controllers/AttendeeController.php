<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendeeRegistrationRequest;

use Illuminate\Support\Facades\Log;

use App\Models\Attendee;

class AttendeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Attendee::paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttendeeRegistrationRequest $request)
    {
        try {
            $validated = $request->validated();

            $attendee = Attendee::create($validated);

            return response()->json([
                'message' => 'Attendee created successfully',
                'attendee'   => $attendee,
            ], 201);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
        return response()->json(['message' => 'Attendee creation failed'], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(Attendee $attendee)
    {
        return response()->json($attendee, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttendeeRegistrationRequest $request)
    {
        try {
            $validated = $request->validated();

            $attendee = Attendee::find($validated['id']);
            $attendee->update($validated);
            
            $attendee->update($validated);
            
            return response()->json([
                'message' => 'Attendee updated successfully',
                'attendee'   => $attendee,
            ], 200);
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
        }
        return response()->json(['message' => 'Attendee not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attendee $attendee)
    {
        $attendee->delete();
        return response()->json(['message' => 'Event deleted successfully'], 200);
    }
}
