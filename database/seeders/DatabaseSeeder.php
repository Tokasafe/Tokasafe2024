<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

        \App\Models\Roles::factory()->create([
            'name' => 'Administrator',
        ]);
        \App\Models\Roles::factory()->create([
            'name' => 'User',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'User',
        ]);
    }
}
