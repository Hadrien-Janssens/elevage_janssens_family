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
            'body_color' => 'Brown Mackerel Tabby',
            'gender' => 'Mâle',
            'race' => 'British shorthair',
            'litter_id' => 1,
            'description' => 'Snow est un chat timide et réservé. Il préfère observer son environnement avant de s\'approcher des gens. Il a besoin de temps pour s\'adapter à son nouvel environnement.',
            'price' => 900,
        ]);

        Kitten::create([
            'name' => 'Sya',
            'body_color' => 'Brown Mackerel Tabby',
            'gender' => 'Femelle',
            'race' => 'British shorthair',
            'litter_id' => 1,
            'description' => 'Sya est une petite aventurière. Elle adore grimper et explorer son environnement.',
            'price' => 900,
        ]);
        Kitten::create([
            'name' => 'Bandit',
            'body_color' => 'Ecaille de tortue',
            'gender' => 'Femelle',
            'race' => 'British shorthair',
            'litter_id' => 1,
            'description' => 'Bandit est très curieuse et aime jouer avec ses frères et sœurs.',
            'price' => 900,
        ]);

        Kitten::create([
            'name' => 'Muffin',
            'body_color' => 'Black silver blocked tabby',
            'gender' => 'Mâle',
            'race' => 'British Longhair',
            'litter_id' => 1,
            'description' => 'Muffin est une adorable petite boule de poils avec un pelage doux et soyeux. Il est très gourmand et peu sportif, il préfère passer de longues heures à se prélasser au soleil.',
            'price' => 900,
        ]);

        Kitten::create([
            'name' => 'Sushi',
            'body_color' => 'Cream mackerel tabby',
            'gender' => 'Mâle',
            'race' => 'British Longhair',
            'litter_id' => 1,
            'description' => 'Sushi est un petit chat très affectueux et câlin. Il adore se blottir dans les bras et ronronner comme un petit moteur.',
            'description' => '',
            'price' => 900,
        ]);

        Kitten::create([
            'name' => 'Snow',
            'body_color' => 'Brown Mackerel Tabby',
            'gender' => 'Mâle',
            'race' => 'British shorthair',
            'litter_id' => 1,
            'description' => 'Snow est un chat timide et réservé. Il préfère observer son environnement avant de s\'approcher des gens. Il a besoin de temps pour s\'adapter à son nouvel environnement.',
            'price' => 900,
        ]);
    }
}
