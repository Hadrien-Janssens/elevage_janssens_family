<?php

namespace Database\Seeders;

use App\Models\Content;
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
            'name' => config('services.env.ADMIN_NAME'),
            'password' => bcrypt(config('services.env.ADMIN_PASSWORD')),
            'email' => config('services.env.ADMIN_EMAIL'),
        ]);



        $this->call([
            // CatsSeeder::class,
            // LitterSeeder::class,
            // KittenSeeder::class,
            // ContentSeeder::class,
        ]);
    }
}
