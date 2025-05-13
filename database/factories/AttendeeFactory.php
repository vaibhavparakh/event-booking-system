<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Attendee;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendee>
 */
class AttendeeFactory extends Factory
{
    protected $model = Attendee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'mobile_number' => $this->faker->numerify('9#########'), // Indian mobile number format
            'email' => $this->faker->unique()->safeEmail(),
            'gender' => $this->faker->randomElement(['male', 'female', 'other']),
            'occupation' => $this->faker->randomElement(['student', 'engineer', 'teacher', 'doctor', 'freelancer']),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'age' => $this->faker->numberBetween(18, 60),
        ];
    }
}
