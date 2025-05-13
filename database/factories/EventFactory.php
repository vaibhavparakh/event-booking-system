<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'from_date_time' => $this->faker->dateTimeBetween('+2 days', '+3 days')->format('Y-m-d H:i:s'),
            'to_date_time' => $this->faker->dateTimeBetween('+4 days', '+5 days')->format('Y-m-d H:i:s'),
            'venue' => $this->faker->address(),
            'location_url' => $this->faker->url(),
            'organised_by' => $this->faker->company(),
            'duration_in_hrs' => $this->faker->numberBetween(1, 120),
            'cover_image_url' => $this->faker->imageUrl(),
            'entry_fee' => $this->faker->numberBetween(100, 10000),
            'capacity' => $this->faker->numberBetween(100, 1000),
            'type' => 'paid', // static value
            'status' => 'published', // static value
            'category' => 'concert', // static value
            'mode' => 'online', // static value
            'country' => $this->faker->country()
        ];
    }
}
