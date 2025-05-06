<?php

namespace Database\Seeders;

use App\Models\BodyColor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BodyColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            'Black',
            'Black Silver',
            'Black Smoke',
            'Black Tabby',
            'Blue',
            'White',
            'Gray',
            'Brown',
            'Orange',
            'Cream',
            'Calico',
            'Tabby',
            'Tortoiseshell',
        ];

        foreach ($colors as $color) {
            BodyColor::create([
                'name' => $color,
            ]);
        }
    }
}
