<?php

namespace Database\Seeders;

use App\Models\ImagesKitten;
use App\Models\Litter;
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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);



        $this->call([
            BodyColorSeeder::class,
            CatsSeeder::class,
            LitterSeeder::class,
            KittenSeeder::class,
        ]);

        ImagesKitten::create([
            'kitten_id' => 1,
            'image_path' => '6818b81f82e8f.jpg',
        ]);
    }
}
