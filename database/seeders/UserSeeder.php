<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomBook;
use App\Models\RoomImage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'role' => 'admin',
        ]);
        User::factory(10)
            ->has(Room::factory(6))
            ->create();
    }
}
