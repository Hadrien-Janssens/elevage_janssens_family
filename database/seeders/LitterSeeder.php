<?php

namespace Database\Seeders;

use App\Models\Litter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LitterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Litter::create([
            'name' => 'Les pipous',
            'birth_date' => '2023-02-17',
            'mother_id' => '2',
            'father_id' => '1',
        ]);
    }
}
