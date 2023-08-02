<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class RoomBookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
			'user_id' => fake()->numberBetween(1, 10),
			'room_id' => fake()->numberBetween(1, 10),
			'check_in' => fake()->date(),
			'check_out' => fake()->date(),

        ];
    }
}
