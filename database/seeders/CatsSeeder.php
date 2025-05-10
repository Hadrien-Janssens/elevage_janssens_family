<?php

namespace Database\Seeders;

use App\Models\Cat;
use App\Models\Cats;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cat::create([
            'name' => 'Urban',
            'body_color' => 'Black Silver tabby',
            'gender' => 'Mâle',
            'race' => 'British shorthair',
            'birthday' => '2023-04-28',
            'description' => 'Un chat noir et blanc avec une personnalité amicale.',

        ]);

        Cat::create([
            'name' => 'Una',
            'body_color' => 'Blue',
            'gender' => 'Femelle',
            'race' => 'Scottish fold shorthair',
            'birthday' => '2023-04-17',
            'description' => 'Un chat blue et blanc avec une personnalité amicale.',

        ]);
    }
}
