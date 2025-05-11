<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AttendeeController;
use App\Http\Controllers\EventRegistrationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// get all users
Route::get('/users', [UserController::class, 'index']);

Route::controller(EventController::class)->group(function () {
    Route::get('/events', 'index');
    Route::post('/event', 'store');
    Route::put('/event', 'update');
    Route::delete('/event/{event}', 'destroy');
    
    // get event by id
    Route::get('/event/{event}', 'show');
})->middleware('throttle:10,1');

Route::controller(AttendeeController::class)->group(function () {
    // get all registrations
    Route::get('/attendees', 'index');
    
    // registration CRUD operations
    Route::post('/attendee/register', 'store');
    Route::put('/attendee', 'update');
    Route::delete('/attendee/{attendee}', 'destroy');
    
    // get attendee by id
    Route::get('/attendee/{attendee}', 'show');
})->middleware('throttle:10,1');

Route::controller(EventRegistrationController::class)->group(function () {
    // registration CRUD operations
    Route::post('/event/attendee/register', 'store');
    Route::delete('/event/attendee/remove/{event}/{attendee}', 'destroy');
    
    // get total attendees for an event
    Route::get('/event/attendees/{event}', 'attendees');
})->middleware('throttle:10,1');