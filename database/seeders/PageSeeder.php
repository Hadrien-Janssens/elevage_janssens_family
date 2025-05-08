<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'name' => 'Accueil'
        ]);
        Page::create([
            'name' => 'A Propos'
        ]);
        Page::create([
            'name' => 'Nos chatons'
        ]);
        Page::create([
            'name' => 'Nos chats'
        ]);
        Page::create([
            'name' => 'Conditons d\'adoptions'
        ]);
    }
}
