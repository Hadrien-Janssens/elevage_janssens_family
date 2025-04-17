<?php

namespace Database\Seeders;

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
        Cats::create([
            'name' => 'Urban',
            'body_color_id' => 1,
            'gender' => 'Mâle',
            'birthday' => '2023-04-28',
            'description' => 'Un chat noir et blanc avec une personnalité amicale.',

        ]);

        Cats::create([
            'name' => 'Una',
            'body_color_id' => 5,
            'gender' => 'Femelle',
            'birthday' => '2023-04-17',
            'description' => 'Un chat blue et blanc avec une personnalité amicale.',

        ]);
    }
}
