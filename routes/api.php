<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRegistrationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// get all users
Route::get('/users', [UserController::class, 'index']);

Route::controller(EventController::class)->group(function () {
    Route::get('/events', 'index');
    Route::post('/events', 'store');
    Route::put('/events/{event}', 'update');
    Route::delete('/events/{event}', 'destroy');
    
    // get event by id
    Route::get('/events/{event}', 'show');
    
    // get total attendees for an event
    Route::get('/events/{event}/attendees', 'attendees');
});

Route::controller(EventRegistrationController::class)->group(function () {
    // get all registrations
    Route::get('/event-registrations', 'index');
    
    // registration CRUD operations
    Route::post('/event-registrations', 'store');
    Route::delete('/event-registrations/{registration}', 'destroy');
    
    // get user registrations
    Route::get('/my-events/{mobile_number}', 'myEvents');
});