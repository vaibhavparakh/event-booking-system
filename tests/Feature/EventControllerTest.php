<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\Attendee;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_index_returns_paginated_events()
    {
        Event::factory()->count(20)->create();

        $response = $this->getJson('/api/events');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data', 'links', 'total'
        ]);
    }

    public function test_store_creates_event_successfully()
    {
        $data = [
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(),
            'from_date_time' => fake()->dateTimeBetween('+2 days', '+3 days')->format('Y-m-d H:i:s'),
            'to_date_time' => fake()->dateTimeBetween('+4 days', '+5 days')->format('Y-m-d H:i:s'),
            'venue' => fake()->address(),
            'location_url' => fake()->url(),
            'organised_by' => fake()->company(),
            'duration_in_hrs' => fake()->numberBetween(1, 120),
            'cover_image_url' => fake()->imageUrl(),
            'entry_fee' => fake()->numberBetween(100, 10000),
            'capacity' => fake()->numberBetween(100, 1000),
            'type' => 'paid', // static value
            'status' => 'published', // static value
            'category' => 'concert', // static value
            'mode' => 'online', // static value
            'country' => fake()->country()
        ];

        $response = $this->postJson('/api/event', $data);

        $response->assertStatus(201);
        $response->assertJson([
            'message' => 'Event created successfully',
            'event' => $data,
        ]);

        $this->assertDatabaseHas('events', $data);
    }

    public function test_store_fails_validation()
    {
        $data = []; // Missing required fields

        $response = $this->postJson('/api/event', $data);

        $response->assertStatus(422);
    }


    public function test_show_returns_event_details()
    {
        $event = Event::factory()->create();

        $response = $this->getJson('/api/event/' . $event->id);
        
        $response->assertStatus(200);
        $response->assertJson([
            "id" => $event->id,
            "title" => $event->title,
            "description" => $event->description,
            "from_date_time" => $event->from_date_time,
            "to_date_time" => $event->to_date_time,
            "venue" => $event->venue,
            "location_url" => $event->location_url,
            "organised_by" => $event->organised_by,
            "duration_in_hrs" => $event->duration_in_hrs,
            "cover_image_url" => $event->cover_image_url,
            "entry_fee" => $event->entry_fee,
            "capacity" => $event->capacity,
            "type" => $event->type,
            "status" => $event->status,
            "category" => $event->category,
            "mode" => $event->mode,
            "created_at" => $event->created_at,
            "updated_at" => $event->updated_at,
            "country" => $event->country
        ]);
    }

    public function test_update_event_successfully()
    {
        $event = Event::factory()->create();

        $updatedTitle = fake()->sentence();
        $updatedDescription = fake()->paragraph(); 
        $data = [
            "title" => $updatedTitle,
            "description" => $updatedDescription,
            "from_date_time" => $event->from_date_time,
            "to_date_time" => $event->to_date_time,
            "venue" => $event->venue,
            "location_url" => $event->location_url,
            "organised_by" => $event->organised_by,
            "duration_in_hrs" => $event->duration_in_hrs,
            "cover_image_url" => $event->cover_image_url,
            "entry_fee" => $event->entry_fee,
            "capacity" => $event->capacity,
            "type" => $event->type,
            "status" => $event->status,
            "category" => $event->category,
            "mode" => $event->mode,
            "created_at" => $event->created_at,
            "updated_at" => $event->updated_at,
            "country" => $event->country,
            "id" => $event->id
        ];

        $response = $this->putJson('/api/event', $data);

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Event updated successfully',
            'event' => $data,
        ]);

        $this->assertDatabaseHas('events', ['title' => $updatedTitle, 'description' => $updatedDescription]);
    }

    public function test_update_event_with_invalid_id()
    {
        $event = Event::factory()->create();

        $updatedTitle = fake()->sentence();
        $updatedDescription = fake()->paragraph(); 
        $data = [
            "title" => $updatedTitle,
            "description" => $updatedDescription,
            "from_date_time" => $event->from_date_time,
            "to_date_time" => $event->to_date_time,
            "venue" => $event->venue,
            "location_url" => $event->location_url,
            "organised_by" => $event->organised_by,
            "duration_in_hrs" => $event->duration_in_hrs,
            "cover_image_url" => $event->cover_image_url,
            "entry_fee" => $event->entry_fee,
            "capacity" => $event->capacity,
            "type" => $event->type,
            "status" => $event->status,
            "category" => $event->category,
            "mode" => $event->mode,
            "created_at" => $event->created_at,
            "updated_at" => $event->updated_at,
            "country" => $event->country,
            "id" => 999999
        ];

        $response = $this->putJson('/api/event', $data);

        $response->assertStatus(404);
        $response->assertJson(['message' => 'Event not found']);
    }

    public function test_update_event_missing_id()
    {
        $event = Event::factory()->create();

        $updatedTitle = fake()->sentence();
        $updatedDescription = fake()->paragraph(); 
        $data = [
            "title" => $updatedTitle,
            "description" => $updatedDescription,
            "from_date_time" => $event->from_date_time,
            "to_date_time" => $event->to_date_time,
            "venue" => $event->venue,
            "location_url" => $event->location_url,
            "organised_by" => $event->organised_by,
            "duration_in_hrs" => $event->duration_in_hrs,
            "cover_image_url" => $event->cover_image_url,
            "entry_fee" => $event->entry_fee,
            "capacity" => $event->capacity,
            "type" => $event->type,
            "status" => $event->status,
            "category" => $event->category,
            "mode" => $event->mode,
            "created_at" => $event->created_at,
            "updated_at" => $event->updated_at,
            "country" => $event->country
        ];

        $response = $this->putJson('/api/event', $data);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Invalid event!']);
    }

    public function test_destroy_deletes_event_and_registrations()
    {
        $event = Event::factory()->create();
        EventRegistration::factory()->count(3)->create(['event_id' => $event->id]);

        $response = $this->deleteJson('/api/event/' . $event->id);

        $response->assertStatus(200);
        $response->assertJson(['message' => 'Event deleted successfully']);

        $this->assertDatabaseMissing('events', ['id' => $event->id]);
        $this->assertDatabaseMissing('event_registrations', ['event_id' => $event->id]);
    }
}
