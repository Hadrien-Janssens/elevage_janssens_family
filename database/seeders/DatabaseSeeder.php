<?php

namespace Database\Seeders;

use App\Models\Images_kitten;
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

        Images_kitten::create([
            'kitten_id' => 1,
            'image_path' => 'julien.jpeg',
        ]);
    }
}
