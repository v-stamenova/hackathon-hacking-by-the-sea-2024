<?php

namespace Database\Seeders;

use App\Models\Group;
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
//        User::factory(10)->create();

        Group::create([
            'name' => 'cool guys',
            'description' => 'cool description'
        ]);

        Group::create([
            'name' => 'cool girls',
            'description' => 'very cool description'
        ]);

        foreach(Group::all() as $group) {
            $group->users()->attach(User::factory(3)->create());
        }
    }
}
