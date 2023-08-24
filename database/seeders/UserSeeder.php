<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomBook;
use App\Models\RoomImage;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::factory()->create([
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);
        User::factory(10)
            ->has(Room::factory(6))
            ->create();
    }
}
