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
            'name' => config('services.env.admin_name'),
            'password' => bcrypt(config('services.env.admin_password')),
            'email' => config('services.env.admin_email'),
        ]);



        $this->call([
            CatsSeeder::class,
            LitterSeeder::class,
            KittenSeeder::class,
            ContentSeeder::class,
        ]);
    }
}
