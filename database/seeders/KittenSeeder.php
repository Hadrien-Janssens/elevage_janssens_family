<?php

namespace Database\Seeders;

use App\Models\Kitten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KittenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kitten::create([
            'name' => 'Snow',
            'body_color' => 'Black Silver tabby',
            'gender' => 'Mâle',
            'race' => 'British shorthair',
            'litter_id' => 1,
            'description' => 'Un chat blue et blanc avec une personnalité amicale.',
            'price' => 1000,
        ]);

        Kitten::create([
            'name' => 'Sia',
            'body_color' => 'Blue',
            'gender' => 'Femelle',
            'race' => 'Scottish fold shorthair',
            'litter_id' => 1,
            'description' => 'Un chat blue et blanc avec une personnalité amicale.',
            'price' => 900,
        ]);
    }
}
