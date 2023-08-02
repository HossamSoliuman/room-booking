<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
			'activated'=>fake()->boolean(),
			'title'=>fake()->text(50),
			'description'=>fake()->text(),
			'city_id'=>fake()->numberBetween(1,10),
			'location'=>fake()->text(50),
			'user_id'=>fake()->numberBetween(1,10),
			'price_per_day'=>fake()->numberBetween(50,200),
			'number_of_beds'=>fake()->numberBetween(1,3),

        ];
    }
}
