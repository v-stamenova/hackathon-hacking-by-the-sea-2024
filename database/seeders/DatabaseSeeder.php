<?php

namespace Database\Seeders;

use App\Models\Award;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);


        Award::create([
            'name' => "The start!",
            'description' => 'You successfully asked DaanGPT for the first time',
            'baseline' => 1,
            'type' => 'score',
            'path' => '/awards/first-message.png'
        ]);

        Award::create([
            'name' => "Lone wolf",
            'description' => 'You created a room by yourself',
            'baseline' => 1,
            'type' => 'members',
            'path' => '/awards/lone-wolf.png'
        ]);
    }
}
