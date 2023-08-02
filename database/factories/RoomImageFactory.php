<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class RoomImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
			'room_id'=>fake()->numberBetween(1,10),
			'path'=>fake()->imageUrl(50),

        ];
    }
}
