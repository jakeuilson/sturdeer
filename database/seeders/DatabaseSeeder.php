<?php

namespace Database\Seeders;

use App\Models\Trend;
use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'John Doe',
            'email'=> 'doe@nemomail.com',
        ]);
        $trends = [
            'Recent',
            'Popular',
        ];

        foreach ($trends as $trend) {
            Trend::create(['name'=> $trend]);
        }

        Post::factory(100)->create();
    }
}